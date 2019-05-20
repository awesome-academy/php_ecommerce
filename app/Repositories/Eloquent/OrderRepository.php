<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\Product;
use DB;
use Auth;
use App\Jobs\SendEmailJob;
use App\Events\OrderStatus;
use App\Notifications\OrderStatusUpdated;
use Charts;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function model()
    {
        return Order::class;
    }

    public function countWithStatus($status)
    {
        $orders = $this->model->whereStatus($status)->count();

        return $orders;
    }

    public function getOrderWithUserAndPayment()
    {
        $orders = $this->model->with('user')->with('payment')->get();

        return $orders;
    }

    public function ajaxDetailOrder($id)
    {
        try {
            $order = $this->getWith('products', $id);
            $products = $order->products()->get();

            return $products;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function updateOrderAndSendEvent(array $request, $id)
    {
        $order = $this->find($id);
        if ($order) {
            $order->update($request);
            event(new OrderStatus($order));
            $order->user->notify(new OrderStatusUpdated($order));

            return true;
        }

        return false;
    }

    public function storeOrder(array $request, $oldCart)
    {
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->payment_id = $request['payment_name'];
            $order->total_price = $oldCart->totalPrice;
            $order->save();
            foreach ($oldCart->items as $cartItem) {
                $product = Product::findOrFail($cartItem['item']['id']);

                if ($product->stock_quantity >= $cartItem['qty']) {
                    $product->stock_quantity -= $cartItem['qty'];
                    $product->save();
                    $order->products()->attach($order->id, [
                        'product_id' => $cartItem['item']['id'],
                        'quantity' => $cartItem['qty'],
                        'price' => $cartItem['price'],
                    ]);
                } else {
                    DB::rollback();

                    return false;
                }
            }
            session()->forget('cart');
            DB::commit();
            dispatch(new SendEmailJob($order, Auth::user()));

            return true;
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function getCharts()
    {
        $ordersByMonth = $this->model->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chartMonth = $this->createChart($ordersByMonth, trans('admin.chart.order.title.detail_month'), trans('admin.chart.order.label.total'), 'bar')->groupByMonth(date('Y'), true);

        $ordersByYear = $this->model->all();
        $chartYear = $this->createChart($ordersByYear, trans('admin.chart.order.title.detail_year'), trans('admin.chart.order.label.total'), 'bar')->groupByYear(config('setting.chart.num_year'));

        return [
            'chartMonth' => $chartMonth,
            'chartYear' => $chartYear,
        ];
    }

    public function createChart($data, $title, $label, $type)
    {
        $chart = Charts::database($data, $type, 'highcharts')
                  ->title($title)
                  ->elementLabel($label)
                  ->dimensions(config('setting.chart.dimensions.width'), config('setting.chart.dimensions.height'))
                  ->responsive(true);

        return $chart;
    }
}

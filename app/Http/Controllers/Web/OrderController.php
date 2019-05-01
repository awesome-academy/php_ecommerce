<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Product;
use Auth;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $payments = Payment::pluck('name', 'id');

        return view('shop.cart.checkout', [
            'user' => $user,
            'payments' => $payments,
        ]);
    }

    public function store(Request $request)
    {
        $oldCart = session('cart', null);
        if ($oldCart == null || $oldCart->totalQty == 0) {
            return redirect()->route('user.profile')->with([
                'level' => 'danger',
                'message' => trans('common.user.order.fail'),
            ]);
        }

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->payment_id = $request->payment_name;
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

                    return redirect()->route('user.profile')->with([
                        'level' => 'danger',
                        'message' => trans('common.user.order.qty_fail'),
                    ]);
                }
            }
            session()->forget('cart');
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('user.profile')->with([
            'level' => 'success',
            'message' => trans('common.user.order.success'),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Payment;
use App\Events\OrderStatus;
use App\Notifications\OrderStatusUpdated;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->middleware(['auth', 'admin']);
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getOrderWithUserAndPayment();

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = $this->orderRepository->getWith('products', $id);

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    public function edit($id)
    {
        $order = $this->orderRepository->getWith('user', $id);
        $payments = Payment::pluck('name', 'id');
        $optionStatus = trans('admin.option.status');

        return view('admin.orders.edit', [
            'order' => $order,
            'payments' => $payments,
            'optionStatus' => $optionStatus,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($this->orderRepository->updateOrderAndSendEvent($request->all(), $id)) {
            return redirect()->route('orders.index');
        }
    }

    public function destroy($id)
    {
        $this->orderRepository->delete($id);

        return response()->json([
            'message' => trans('admin.message.order.delete.success'),
            'level' => 'success',
        ]);
    }
}

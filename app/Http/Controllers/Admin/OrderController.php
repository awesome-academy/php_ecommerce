<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $orders = Order::with('user')->with('payment')->get();

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    public function edit($id)
    {
        $order = Order::with('user')->findOrFail($id);
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
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.index');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => trans('admin.message.order.delete.success'),
            'level' => 'success',
        ]);
    }
}

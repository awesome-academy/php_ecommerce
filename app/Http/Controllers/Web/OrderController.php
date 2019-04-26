<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Auth;

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

        $order = new Order();
        $order->user_id = Auth::id();
        $order->payment_id = $request->payment_name;
        $order->total_price = $oldCart->totalPrice;
        $order->save();

        foreach ($oldCart->items as $cartItem) {
            $order->products()->attach($order->id, [
                'product_id' => $cartItem['item']['id'],
                'quantity' => $cartItem['qty'],
                'price' => $cartItem['price'],
            ]);
        }
        session()->forget('cart');

        return redirect()->route('user.profile')->with([
            'level' => 'success',
            'message' => trans('common.user.order.success'),
        ]);
    }
}

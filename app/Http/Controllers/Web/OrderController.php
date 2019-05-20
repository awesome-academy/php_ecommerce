<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Auth;

class OrderController extends Controller
{
    private $orderRepository;
    private $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
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
        if ($this->orderRepository->storeOrder($request->all(), $oldCart)) {
            return redirect()->route('user.profile')->with([
                'level' => 'success',
                'message' => trans('common.user.order.success'),
            ]);
        } else {
            return redirect()->route('user.profile')->with([
                'level' => 'danger',
                'message' => trans('common.user.order.qty_fail'),
            ]);
        }
    }
}

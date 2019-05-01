<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('shop.cart.index');
    }

    public function store(Request $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $oldCart = session('cart', null);
        $cart = new Cart($oldCart);
        $cart->addItemToCart($product, $product->id);
        session(['cart' => $cart]);

        return response()->json([
            'level' => 'success',
            'message' => trans('common.cart.add_success'),
            'product' => $product,
            'cart' => $cart,
        ]);
    }

    public function destroy(Request $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $oldCart = session('cart', null);
        $cart = new Cart($oldCart);
        $cart->removeItem($product, $product->id);
        session(['cart' => $cart]);

        return response()->json([
            'level' => 'success',
            'message' => trans('common.cart.delete_success'),
            'product' => $product,
            'cart' => $cart,
        ]);
    }

    public function updateIncrease(Request $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $oldCart = session('cart', null);
        $cart = new Cart($oldCart);
        $cart->increaseItem($product, $product->id);
        session(['cart' => $cart]);

        return response()->json([
            'cart' => $cart,
        ]);
    }

    public function updateDecrease(Request $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $oldCart = session('cart', null);
        $cart = new Cart($oldCart);
        $cart->decreaseItem($product, $product->id);
        session(['cart' => $cart]);

        return response()->json([
            'cart' => $cart,
        ]);
    }
}

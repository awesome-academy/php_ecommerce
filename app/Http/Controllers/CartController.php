<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Repositories\Contracts\ProductRepositoryInterface;

class CartController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('shop.cart.index');
    }

    public function store(Request $request, $productSlug)
    {
        $product = $this->productRepository->findBySlug($productSlug);
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
        $product = $this->productRepository->findBySlug($productSlug);
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
        $product = $this->productRepository->findBySlug($productSlug);
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
        $product = $this->productRepository->findBySlug($productSlug);
        $oldCart = session('cart', null);
        $cart = new Cart($oldCart);
        $cart->decreaseItem($product, $product->id);
        session(['cart' => $cart]);

        return response()->json([
            'cart' => $cart,
        ]);
    }
}

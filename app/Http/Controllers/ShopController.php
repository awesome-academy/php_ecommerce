<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\Review;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')
                    ->simplePaginate(config('setting.product.number_pagination'));

        return view('shop.index')->with([
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function show($productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $recommendProducts = $this->showMightLikeProduct($product->category->id, $product->id);
        $reviews = Review::with('user')->where('product_id', $product->id)->orderBy('created_at', 'DESC')->get();
        $avgStar = $reviews->avg('rating');

        return view('shop.show')->with([
            'product' => $product,
            'recommendProducts' => $recommendProducts,
            'reviews' => $reviews,
            'avgStar' => round($avgStar, config('setting.product.number_round_rating')),
        ]);
    }

    public function showMightLikeProduct($categoryId, $exceptProductId)
    {
        $products = Product::where('category_id', $categoryId)
                    ->where('id', '!=', $exceptProductId)->inRandomOrder()
                    ->take(config('setting.product.number_recommendation'))->get();

        return $products;
    }
}

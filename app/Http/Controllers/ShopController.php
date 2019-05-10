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
        $product = Product::name($productSlug)->first();
        $recommendProducts = $this->showMightLikeProduct($product->category->id, $product->id);
        $reviews = Review::with('user')->where('product_id', $product->id)->latest()->simplePaginate(config('setting.review.number_retrieve'));
        $avgStar = $reviews->avg('rating');
        $viewedProducts = $this->storeViewedProducts($product, $product->id);

        return view('shop.show')->with([
            'product' => $product,
            'recommendProducts' => $recommendProducts,
            'reviews' => $reviews,
            'avgStar' => round($avgStar, config('setting.product.number_round_rating')),
            'viewedProducts' => $viewedProducts,
        ]);
    }

    public function showMightLikeProduct($categoryId, $exceptProductId)
    {
        $products = Product::where('category_id', $categoryId)
                    ->where('id', '!=', $exceptProductId)->inRandomOrder()
                    ->take(config('setting.product.number_recommendation'))->get();

        return $products;
    }

    public function storeViewedProducts($product, $id)
    {
        $products = session('viewedProducts', null);
        $storedProduct = $product;

        if ($products && array_key_exists($id, $products)) {
            $storedProduct = $products[$id];
        }
        $products[$id] = $storedProduct;
        session(['viewedProducts' => $products]);

        return $products;
    }


    public function filterCategory($slug)
    {

        $category = Category::name($slug)->first();
        $productsByCategories = Product::where('category_id', $category->id)->get();

        return response()->json([
            'products' => $productsByCategories,
        ]);
    }

    public function filterPrice($data)
    {
        $priceRange = explode(';', $data);
        $productByPrice = Product::price($priceRange[0], $priceRange[1])->get();

        return response()->json([
            'products' => $productByPrice,
        ]);
    }
}

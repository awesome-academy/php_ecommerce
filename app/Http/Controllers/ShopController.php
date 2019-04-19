<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
}

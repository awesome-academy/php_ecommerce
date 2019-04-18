<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::inRandomOrder()->take(config('setting.product.number_retrieve'))->get();

        return view('welcome')->with('products', $products);
    }
}

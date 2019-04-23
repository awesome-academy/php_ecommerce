<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('reviews')
                    ->join('products', 'reviews.product_id', '=', 'products.id')
                    ->select(DB::raw('avg(rating) as average, products.*'))
                    ->groupBy('product_id')
                    ->orderBy('average', 'desc')
                    ->take(config('setting.product.number_retrieve'))
                    ->get();

        return view('welcome')->with('products', $products);
    }
}

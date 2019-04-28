<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RequestProduct;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $products = Product::with('category')->get();
        $requests = RequestProduct::with('user')->get();

        return view('admin.products.index', [
            'products' => $products,
            'requests' => $requests,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\RequestProduct;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $orders = Order::all()->count();
        $requests = RequestProduct::all()->count();

        return view('admin.index', [
            'users' => $users,
            'orders' => $orders,
            'requests' => $requests,
        ]);
    }
}

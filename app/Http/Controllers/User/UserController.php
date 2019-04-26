<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateProductSuggestRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\RequestProduct;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('user.profile')->with('user', $user);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.profile')->with([
            'level' => 'success',
            'message' => @trans('common.user.update.success'),
        ]);
    }

    public function requestProduct(CreateProductSuggestRequest $request)
    {
        $user = Auth::user();
        $requestProduct = new RequestProduct();
        $requestProduct->product_name = $request->product_name;
        $requestProduct->description = $request->description;
        $user->requestProducts()->save($requestProduct);

        return redirect()->route('user.profile')->with([
            'level' => 'success',
            'message' => @trans('common.user.request_product.success'),
        ]);
    }
}

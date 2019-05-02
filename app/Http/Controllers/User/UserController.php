<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateProductSuggestRequest;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\RequestProduct;
use File;

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
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        if ($request->image) {
            $path = public_path(config('setting.user.image_path'));
            $oldAva = $user->image;

            $fileUpload = $request->image;
            $nameFileUpload = uniqid() . '.' . $fileUpload->getClientOriginalExtension();
            $fileUpload->move($path, $nameFileUpload);
            $user->image = $nameFileUpload;

            if ($user->save()) {
                if (File::exists($path . $oldAva) && $oldAva != config('setting.user.image_default')) {
                    File::delete($path . $oldAva);
                }
            }
        }
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

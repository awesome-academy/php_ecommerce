<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

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
}

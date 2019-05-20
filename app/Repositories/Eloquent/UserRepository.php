<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use File;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function updateProfile($request)
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

                    return true;
                }
            }
        }
        $user->save();

        return true;
    }
}

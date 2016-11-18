<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

class UserController extends Controller
{
    public function newPassword()
    {
        return view('auth.newpassword');
    }

    public function handleNewPassword(Request $request, User $user)
    {
        $post = $request->all();

        $rules = [
            'old_password' => 'required|min:4',
            'password' => 'required|min:4|confirmed',
        ];
        $valid = Validator::make($post, $rules);

        if (Hash::check($request->input('old_password'), $user->password)) {

        } else {
            return back()->with('flash_danger', trans('string.incorrect_user_password'));
        }

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput()->with('flash_danger', trans('string.incorrect_user_password'));
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('home')->with('flash_success', trans('string.edit_applicant_success'));
    }

    public function changeAvatar()
    {
        return view('auth.changeavatar');
    }

    public function handleAvatar(Request $request, User $user)
    {
        $post = $request->all();

        $rules = [
            'avatar' => 'required|file|mimes:jpeg,bmp,png',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $path = $request->file('avatar')->store('avatars');

        $user->avatar = $path;
        $user->save();

        return redirect()->route('home')->with('flash_success', trans('string.edit_applicant_success'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function login()
    {
        if(Auth::guest()){
            return view('auth.login');
        } else {
            return redirect('home');
        }
    }

    public function handleLogin(Request $request)
    {
        $post = $request->all();

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid);
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'))) {
            return redirect()->intended('home')->with('flash_success', trans('string.successful_login'));
        } else {
            return back()->with('flash_danger', trans('string.incorrect_user_password').' '.$request->input('remember'));
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function Logout()
    {
        Auth::logout();
        return redirect()->action('HomeController@index')->with('flash_success',trans('string.successful_logout'));
    }
}

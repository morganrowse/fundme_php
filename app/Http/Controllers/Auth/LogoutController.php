<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function Logout()
    {
        Auth::logout();
        return redirect()->action('HomeController@index')->with('flash_success',trans('string.successful_logout'));
    }
}

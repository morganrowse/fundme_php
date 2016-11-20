<?php

namespace App\Http\Controllers;

use App\Application;
use App\Fundme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->userable_type == 'App\Applicant') {

            $parameters = [
            ];
            return view('home.applicant')->with($parameters);
        }

        if (Auth::user()->userable_type = 'App\Administrator') {
            return view('home.administrator');
        }

    }
}

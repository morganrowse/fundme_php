<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function handleApplicants(Request $request)
    {
        $post = $request->all();

        $rules = [
            'applicant' => 'required|integer|max:50|min:1',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        //Artisan::call('db:seed');

        return redirect()->route('admin')->with('flash_success', trans('string.new_applicant_success'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Applicant;
use App\Fundme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        if(Auth::guest()){
            return view('auth.register');
        } else {
            return redirect('home');
        }
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'student_number' => 'required|max:255',
            'cellphone' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:4|confirmed',

            'address_line_1' => 'max:255',
            'address_line_2' => 'max:255',
            'address_line_3' => 'max:255',
            'address_line_4' => 'max:255',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $applicant = new Applicant();
        $applicant->student_number = $request->input('student_number');
        $applicant->cellphone = $request->input('cellphone');
        $applicant->address_line_1 = $request->input('address_line_1');
        $applicant->address_line_2 = $request->input('address_line_2');
        $applicant->address_line_3 = $request->input('address_line_3');
        $applicant->address_line_4 = $request->input('address_line_4');
        $applicant->save();

        $files = \Illuminate\Support\Facades\Storage::files('defaultavatars');
        $file = $files[rand(0,count($files))];

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->avatar = $file;
        $user->userable_id = $applicant->id;
        $user->userable_type = 'App\Applicant';
        $user->save();

        Fundme::sendNewUserMail($user);

        Auth::login($user);

        return redirect()->action('HomeController@index');
    }
}

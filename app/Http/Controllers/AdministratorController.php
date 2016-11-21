<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class AdministratorController extends Controller
{
    public function index()
    {
        $administrators = Administrator::orderBy('updated_at', 'desc')->get();

        $parameters = [
            'administrators' => $administrators,
        ];

        return view('administrators.index')->with($parameters);
    }

    public function create()
    {

        $parameters = [
        ];

        return view('administrators.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $administrator = new Administrator();
        $administrator->save();

        $password = str_random(8);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($password);
        $user->userable_id = $administrator->id;
        $user->userable_type = 'App\Administrator';
        $user->save();

        Fundme::sendNewUserMail($user,$password);

        return redirect()->route('administrators')->with('flash_success', trans('string.new_administrator_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(Administrator $administrator)
    {

        $parameters = [
            'administrator' => $administrator,
        ];

        return view('administrators.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Administrator $administrator)
    {
        $post = $request->all();

        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,id,'.$administrator->id,
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $user = $administrator->user;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('administrators')->with('flash_success', trans('string.edit_administrator_success'));
    }

    public function handleDelete(Administrator $administrator)
    {
        $administrator->user->delete();
        $administrator->delete();

        return redirect()->back()->with('flash_success', trans('string.delete_administrator_success'));
    }

    public static function getDashboardString()
    {
        $new_count = Administrator::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.administrator',$new_count).'.';
        } else {
            return "No new administrators.";
        }
    }
}

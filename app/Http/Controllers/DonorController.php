<?php

namespace App\Http\Controllers;

use DB;
use App\Donor;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::orderBy('updated_at', 'desc')->get();

        $parameters = [
            'donors' => $donors,
        ];

        return view('donors.index')->with($parameters);
    }

    public function create()
    {
        $administrators = User::where('userable_type','App\Administrator')->join('administrators', 'users.userable_id', '=', 'administrators.id')->orderBy('first_name','desc')->orderBy('last_name','desc')->select('administrators.id',DB::raw('CONCAT(first_name, " - ", last_name) AS full_name'))->pluck('full_name','administrators.id');

        $parameters = [
            'administrators' => $administrators,
        ];

        return view('donors.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'administrator' => 'required|integer',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'organisation' => 'required|max:255',
            'email' => 'required|max:255',

        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donor = new Donor();
        $donor->administrator_id = $request->input('administrator');
        $donor->first_name = $request->input('first_name');
        $donor->last_name = $request->input('last_name');
        $donor->organisation = $request->input('organisation');
        $donor->email = $request->input('email');

        $donor->address_line_1 = $request->input('address_line_1');
        $donor->address_line_2 = $request->input('address_line_2');
        $donor->address_line_3 = $request->input('address_line_3');
        $donor->address_line_4 = $request->input('address_line_4');

        $donor->save();

        return redirect()->route('donors')->with('flash_success', trans('string.new_donor_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(Donor $donor)
    {
        $administrators = User::where('userable_type','App\Administrator')->join('administrators', 'users.userable_id', '=', 'administrators.id')->orderBy('first_name','desc')->orderBy('last_name','desc')->select('administrators.id',DB::raw('CONCAT(first_name, " - ", last_name) AS full_name'))->pluck('full_name','administrators.id');

        $parameters = [
            'donor' => $donor,
            'administrators' => $administrators,
        ];

        return view('donors.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Donor $donor)
    {
        $post = $request->all();

        $rules = [
            'administrator' => 'required|integer',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'organisation' => 'required|max:255',
            'email' => 'required|max:255',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donor->administrator_id = $request->input('administrator');
        $donor->first_name = $request->input('first_name');
        $donor->last_name = $request->input('last_name');
        $donor->organisation = $request->input('organisation');
        $donor->email = $request->input('email');

        $donor->address_line_1 = $request->input('address_line_1');
        $donor->address_line_2 = $request->input('address_line_2');
        $donor->address_line_3 = $request->input('address_line_3');
        $donor->address_line_4 = $request->input('address_line_4');

        $donor->save();

        return redirect()->route('donors')->with('flash_success', trans('string.edit_donor_success'));
    }

    public function handleDelete(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors')->with('flash_success', trans('string.delete_donor_success'));
    }

    public static function getDashboardString()
    {
        $new_count = Donor::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.donor',$new_count).'.';
        } else {
            return "No new donors.";
        }
    }
}

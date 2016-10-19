<?php

namespace App\Http\Controllers;

use App\Application;
use App\Donor;
use App\FundingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;

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

        $parameters = [
        ];

        return view('donors.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donor = new Donor();
        $donor->name = $request->input('name');
        $donor->save();

        return redirect()->route('donors')->with('flash_success', trans('string.new_donor_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(Donor $donor)
    {

        $parameters = [
            'donor' => $donor,
        ];

        return view('donors.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Donor $donor)
    {
        $post = $request->all();

        $rules = [
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donor->name = $request->input('name');
        $donor->save();

        return redirect()->route('donors')->with('flash_success', trans('string.edit_donor_success'));
    }

    public function handleDelete(Donor $donor)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\FundingType;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class FundingTypeController extends Controller
{
    public function index()
    {
        $funding_types = FundingType::orderBy('name')->get();

        $parameters = [
            'funding_types' => $funding_types,
        ];

        return view('fundingtypes.index')->with($parameters);
    }

    public function create()
    {

        $parameters = [
        ];

        return view('fundingtypes.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'name' => 'required|max:255|unique:funding_types',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $funding_type = new FundingType();
        $funding_type->name = $request->input('name');
        $funding_type->save();

        return redirect()->route('fundingtypes')->with('flash_success', trans('string.new_funding_type_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(FundingType $funding_type)
    {

        $parameters = [
            'funding_type' => $funding_type,
        ];

        return view('fundingtypes.edit')->with($parameters);
    }

    public function handleEdit(Request $request, FundingType $funding_type)
    {
        $post = $request->all();

        $rules = [
            'name' => 'required|max:255|unique:funding_types,id,'.$funding_type->id,
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $funding_type->name = $request->input('name');
        $funding_type->save();

        return redirect()->route('fundingtypes')->with('flash_success', trans('string.edit_funding_type_success'));
    }

    public function handleDelete(FundingType $funding_type)
    {
        $funding_type->delete();

        return redirect()->back()->with('flash_success', trans('string.delete_funding_type_success'));
    }

    public static function getDashboardString()
    {
        $new_count = FundingType::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.funding_type',$new_count).'.';
        } else {
            return "No new funding types.";
        }
    }
}

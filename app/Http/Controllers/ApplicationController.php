<?php

namespace App\Http\Controllers;

use App\Application;
use App\FundingType;
use App\Fundme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('applicant','fundingType','applicant.user')->orderBy('updated_at', 'desc')->get();

        $parameters = [
            'applications' => $applications,
        ];

        return view('applications.index')->with($parameters);
    }

    public function create()
    {
        $funding_types = FundingType::pluck('name', 'id');
        $financial_means = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'];

        $parameters = [
            'funding_types' => $funding_types,
            'financial_means' => $financial_means,
        ];

        return view('applications.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'funding_type' => 'required|integer|exists:funding_types,id',
            'institution_name' => 'required|max:255',
            'degree_type' => 'required|max:255',
            'financial_means' => 'required|in:A,B,C,D,E',
            'amount' => 'required|numeric|min:0',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $application = new Application();
        $application->applicant_id = Auth::user()->userable->id;
        $application->funding_type_id = $request->input('funding_type');
        $application->institution_name = $request->input('institution_name');
        $application->degree_type = $request->input('degree_type');
        $application->financial_means = $request->input('financial_means');
        $application->amount = $request->input('amount');
        $application->save();

        Fundme::sendNewApplicationMail($application);

        return redirect()->route('applications')->with('flash_success', trans('string.new_application_success'));
    }

    public function view(Application $application)
    {
        $parameters = [
            'application' => $application,
        ];

        return view('applications.view')->with($parameters);
    }

    public function edit(Application $application)
    {
        $funding_types = FundingType::pluck('name', 'id');
        $financial_means = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'];

        $parameters = [
            'application' => $application,
            'funding_types' => $funding_types,
            'financial_means' => $financial_means,
        ];

        return view('applications.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Application $application)
    {
        $post = $request->all();

        $rules = [
            'funding_type' => 'required|integer|exists:funding_types,id',
            'institution_name' => 'required|max:255',
            'degree_type' => 'required|max:255',
            'financial_means' => 'required|in:A,B,C,D,E',
            'amount' => 'required|numeric|min:0',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $application->applicant_id = Auth::user()->userable->id;
        $application->funding_type_id = $request->input('funding_type');
        $application->institution_name = $request->input('institution_name');
        $application->degree_type = $request->input('degree_type');
        $application->financial_means = $request->input('financial_means');
        $application->amount = $request->input('amount');
        $application->save();

        return redirect()->route('applications')->with('flash_success', trans('string.edit_application_success'));
    }

    public function handleDelete(Application $application)
    {
        $application->delete();

        return redirect()->route('applications')->with('flash_success', trans('string.delete_application_success'));
    }

    public static function getDashboardString()
    {
        $new_count = Application::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.application',$new_count).'.';
        } else {
            return "No new applications.";
        }
    }
}

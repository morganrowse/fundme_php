<?php

namespace App\Http\Controllers;

use DB;
use App\Application;
use App\DonationProfile;
use App\Donation;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::orderBy('updated_at', 'desc')->get();

        $parameters = [
            'donations' => $donations,
        ];

        return view('donations.index')->with($parameters);
    }

    public function create()
    {
        $applications = Application::
        join('applicants','applications.applicant_id','=','applicants.id')
            ->join('users', function ($join) {$join->on('applicants.id', '=', 'users.userable_id')->where('users.userable_type', '=', 'App\Applicant');})
            ->join('funding_types','applications.funding_type_id','=','funding_types.id')
            ->orderBy('users.first_name')
            ->orderBy('users.last_name')
            ->orderBy('funding_types.name')
            ->orderBy('applications.institution_name')
            ->orderBy('applications.degree_type')
            ->orderBy('applications.financial_means')
            ->select('applications.id AS id',DB::raw('CONCAT(users.first_name, ", ", users.last_name, " - ", funding_types.name, " - ", applications.institution_name, " - ", applications.degree_type, " - ", applications.financial_means) AS full_name'))
            ->pluck('full_name', 'id');

        $donation_profiles = DonationProfile::
        join('donors','donation_profiles.donor_id','=','donors.id')
            ->join('funding_types','donation_profiles.funding_type_id','=','funding_types.id')
            ->orderBy('donors.first_name')
            ->orderBy('donors.last_name')
            ->orderBy('donors.organisation')
            ->orderBy('funding_types.name')
            ->select('donation_profiles.id AS id',DB::raw('CONCAT(donors.first_name, ", ", donors.last_name, " - ", donors.organisation, " - ", funding_types.name, " - ", donation_profiles.financial_means) AS full_name'))
            ->pluck('full_name', 'id');

        $parameters = [
            'applications' => $applications,
            'donation_profiles' => $donation_profiles,
        ];

        return view('donations.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'application' => 'required|integer|exists:applications,id',
            'donation_profile' => 'required|integer|exists:donation_profiles,id',
            'amount' => 'required|numeric|min:0',
            'agreement' => 'required|file|mimes:jpeg,bmp,png,pdf',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donation = new Donation();
        $donation->application_id = $request->input('application');
        $donation->donation_profile_id = $request->input('donation_profile');
        $donation->amount = $request->input('amount');
        $donation->save();

        $path = $request->file('agreement')->store('agreements');

        $donation->agreement = $path;
        $donation->save();

        return redirect()->route('donations')->with('flash_success', trans('string.new_donation_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(Donation $donation)
    {
        $applications = Application::
        join('applicants','applications.applicant_id','=','applicants.id')
            ->join('users', function ($join) {$join->on('applicants.id', '=', 'users.userable_id')->where('users.userable_type', '=', 'App\Applicant');})
            ->join('funding_types','applications.funding_type_id','=','funding_types.id')
            ->orderBy('users.first_name')
            ->orderBy('users.last_name')
            ->orderBy('funding_types.name')
            ->orderBy('applications.institution_name')
            ->orderBy('applications.degree_type')
            ->orderBy('applications.financial_means')
            ->select('applications.id AS id',DB::raw('CONCAT(users.first_name, ", ", users.last_name, " - ", funding_types.name, " - ", applications.institution_name, " - ", applications.degree_type, " - ", applications.financial_means) AS full_name'))
            ->pluck('full_name', 'id');

        $donation_profiles = DonationProfile::
        join('donors','donation_profiles.donor_id','=','donors.id')
            ->join('funding_types','donation_profiles.funding_type_id','=','funding_types.id')
            ->orderBy('donors.first_name')
            ->orderBy('donors.last_name')
            ->orderBy('donors.organisation')
            ->orderBy('funding_types.name')
            ->select('donation_profiles.id AS id',DB::raw('CONCAT(donors.first_name, ", ", donors.last_name, " - ", donors.organisation, " - ", funding_types.name, " - ", donation_profiles.financial_means) AS full_name'))
            ->pluck('full_name', 'id');

        $parameters = [
            'donation' => $donation,
            'applications' => $applications,
            'donation_profiles' => $donation_profiles,
        ];

        return view('donations.edit')->with($parameters);
    }

    public function handleEdit(Request $request, Donation $donation)
    {
        $post = $request->all();

        $rules = [
            'application' => 'required|integer|exists:applications,id',
            'donation_profile' => 'required|integer|exists:donation_profiles,id',
            'amount' => 'required|numeric|min:0',
            'agreement' => 'file|mimes:jpeg,bmp,png,pdf',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donation->application_id = $request->input('application');
        $donation->donation_profile_id = $request->input('donation_profile');
        $donation->amount = $request->input('amount');
        $donation->save();

        if ($request->hasFile('agreement')) {
            $path = $request->file('agreement')->store('agreements');

            $donation->agreement = $path;
            $donation->save();
        }

        return redirect()->route('donations')->with('flash_success', trans('string.edit_donation_success'));
    }

    public function handleDelete(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations')->with('flash_success', trans('string.delete_donation_success'));
    }

    public static function getDashboardString()
    {
        $new_count = Donation::where('created_at','>', Carbon::now()->subDay())->count();
        if($new_count!=0){
            return $new_count.' new '.trans_choice('string.donation',$new_count).'.';
        } else {
            return "No new donations.";
        }
    }
}

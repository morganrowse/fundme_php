<?php

namespace App\Http\Controllers;

use App\Donor;
use App\DonationProfile;
use App\FundingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;

class DonationProfileController extends Controller
{
    public function index()
    {
        $donation_profiles = DonationProfile::with('fundingType','donor')->orderBy('updated_at', 'desc')->get();

        $parameters = [
            'donation_profiles' => $donation_profiles,
        ];

        return view('donationprofiles.index')->with($parameters);
    }

    public function create()
    {
        $donors = Donor::
        orderBy('first_name')
            ->orderBy('last_name')
            ->orderBy('organisation')
            ->select('id', DB::raw('CONCAT(first_name, ", ", last_name, " - ", organisation) AS full_name'))
            ->pluck('full_name', 'id');

        $funding_types = FundingType::orderBy('name')->pluck('name', 'id');
        $financial_means = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'];

        $parameters = [
            'donors' => $donors,
            'funding_types' => $funding_types,
            'financial_means' => $financial_means,
        ];

        return view('donationprofiles.create')->with($parameters);
    }

    public function handleCreate(Request $request)
    {
        $post = $request->all();

        $rules = [
            'donor' => 'required|integer|exists:donors,id',
            'funding_type' => 'required|integer|exists:funding_types,id',
            'financial_means' => 'required|in:A,B,C,D,E',
            'maximum_amount' => 'required|numeric|min:0',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donation_profile = new DonationProfile();
        $donation_profile->donor_id = $request->input('donor');
        $donation_profile->funding_type_id = $request->input('funding_type');
        $donation_profile->financial_means = $request->input('financial_means');
        $donation_profile->maximum_amount = $request->input('maximum_amount');
        $donation_profile->save();

        return redirect()->route('donationprofiles')->with('flash_success', trans('string.new_donation_profile_success'));
    }

    public function view($id)
    {
        //
    }

    public function edit(DonationProfile $donation_profile)
    {
        $donors = Donor::
        orderBy('first_name')
            ->orderBy('last_name')
            ->orderBy('organisation')
            ->select('id', DB::raw('CONCAT(first_name, ", ", last_name, " - ", organisation) AS full_name'))
            ->pluck('full_name', 'id');

        $funding_types = FundingType::pluck('name', 'id');
        $financial_means = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E'];

        $parameters = [
            'donation_profile' => $donation_profile,
            'donors' => $donors,
            'funding_types' => $funding_types,
            'financial_means' => $financial_means,
        ];

        return view('donationprofiles.edit')->with($parameters);
    }

    public function handleEdit(Request $request, DonationProfile $donation_profile)
    {
        $post = $request->all();

        $rules = [
            'donor' => 'required|integer|exists:donors,id',
            'funding_type' => 'required|integer|exists:funding_types,id',
            'financial_means' => 'required|in:A,B,C,D,E',
            'maximum_amount' => 'required|numeric|min:0',
        ];
        $valid = Validator::make($post, $rules);

        if (!$valid->passes()) {
            return back()->withErrors($valid)->withInput();
        }

        $donation_profile->donor_id = $request->input('donor');
        $donation_profile->funding_type_id = $request->input('funding_type');
        $donation_profile->financial_means = $request->input('financial_means');
        $donation_profile->maximum_amount = $request->input('maximum_amount');
        $donation_profile->save();

        return redirect()->route('donationprofiles')->with('flash_success', trans('string.edit_donation_profile_success'));
    }

    public function handleDelete(DonationProfile $donation_profile)
    {
        $donation_profile->delete();

        return redirect()->route('donationprofiles')->with('flash_success', trans('string.delete_donation_profile_success'));
    }

    public static function getDashboardString()
    {
        $new_count = DonationProfile::where('created_at', '>', Carbon::now()->subDay())->count();
        if ($new_count != 0) {
            return $new_count . ' new ' . trans_choice('string.donation_profile', $new_count) . '.';
        } else {
            return "No new donation profiles.";
        }
    }
}

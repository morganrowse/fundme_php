<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Application;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function outstandingApplicants(){

        $applicants = Applicant::where('created_at','<',Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->doesntHave('documentation')->get();

        $parameters = [
            'applicants' => $applicants,
        ];

        return view('reports.outstandingapplicants.index')->with($parameters);
    }

    public static function getOutstandingApplicantsDashboardString()
    {
        $applicants = Applicant::where('created_at','<',Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->doesntHave('documentation')->get();

        $new_count = count($applicants);

        if($new_count!=0){
            return $new_count.' outstanding '.trans_choice('string.applicant',$new_count).' needs attention.';
        } else {
            return "No outstanding applicants.";
        }
    }

    public function outstandingApplications(){

        $applications = Application::where('created_at','<',Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->get();

        foreach($applications as $key => $application ){
            if($application->getFundedAmount()>$application->amount/10){
                unset($applications[$key]);
            }
        }

        $parameters = [
            'applications' => $applications,
        ];

        return view('reports.outstandingapplications.index')->with($parameters);
    }

    public static function getOutstandingApplicationsDashboardString()
    {
        $applications = Application::where('created_at','<',Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->get();

        foreach($applications as $key => $application ){
            if($application->getFundedAmount()>$application->amount/10){
                unset($applications[$key]);
            }
        }

        $new_count = count($applications);

        if($new_count!=0){
            return $new_count.' outstanding '.trans_choice('string.application',$new_count).' needs attention.';
        } else {
            return "No outstanding applications.";
        }
    }

    public function fundedPerDegreeType(){

        $applications = Application::where('created_at','<',Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->get();

        foreach($applications as $key => $application ){
            if($application->getFundedAmount()>$application->amount/10){
                unset($applications[$key]);
            }
        }

        $parameters = [
            'applications' => $applications,
        ];

        return view('reports.fundedperdegreetype.index')->with($parameters);
    }
}

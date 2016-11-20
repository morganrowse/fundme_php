<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Application;
use App\Donation;
use App\FundingType;
use ConsoleTVs\Charts\Chart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use ConsoleTVs\Charts\Charts;

class ReportController extends Controller
{
    public function outstandingApplicants()
    {

        $applicants = Applicant::where('created_at', '<', Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->doesntHave('documentation')->get();

        $parameters = [
            'applicants' => $applicants,
        ];

        return view('reports.outstandingapplicants.index')->with($parameters);
    }

    public static function getOutstandingApplicantsDashboardString()
    {
        $applicants = Applicant::where('created_at', '<', Carbon::now()->subMonths(3))->doesntHave('documentation')->get();

        $new_count = count($applicants);

        if ($new_count > 0) {
            return "<tag class='tag tag-pill tag-danger'>" . $new_count . "</tag>";
        } else {
            return "";
        }
    }

    public function outstandingApplications()
    {

        $applications = Application::with('fundingType')->where('created_at', '<', Carbon::now()->subMonths(3))->orderBy('created_at', 'desc')->get();

        foreach ($applications as $key => $application) {
            if ($application->getFundedAmount() > $application->amount / 10) {
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
        $applications = Application::where('created_at', '<', Carbon::now()->subMonths(3))->get();

        foreach ($applications as $key => $application) {
            if ($application->getFundedAmount() > $application->amount / 10) {
                unset($applications[$key]);
            }
        }

        $new_count = count($applications);

        if ($new_count > 0) {
            return "<tag class='tag tag-pill tag-danger'>" . $new_count . "</tag>";
        } else {
            return "";
        }
    }

    public function amountPerFundingType()
    {

        $number_of_months = 6;

        $donations = Donation::with('application.fundingType')->where('donations.created_at', '>', Carbon::now()->subMonths(6))->join('applications', 'donations.id', '=', 'applications.id')->groupBy('funding_type_id')->selectRaw('sum(donations.amount) as sum, funding_type_id')->orderBy('sum', 'desc')->limit($number_of_months)->get();

        $months = [];

        $funding_types = [];

        for ($count = 0; $count < $number_of_months; $count++) {
            $month = Carbon::now()->subMonths($number_of_months - $count);

            foreach ($donations as $donation) {
                $funding_type = FundingType::find($donation->funding_type_id);
                $amount = Donation::whereBetween('donations.created_at', [$month->copy()->startOfMonth(),$month->copy()->endOfMonth()])->join('applications', 'donations.id', '=', 'applications.id')->where('applications.funding_type_id', $donation->funding_type_id)->sum('donations.amount');

                if($count==0){
                    $funding_types[$funding_type->name] =[];
                    array_push($funding_types[$funding_type->name], $amount);
                } else {
                    array_push($funding_types[$funding_type->name], $amount);
                }
            }
            array_push($months, $month->formatLocalized('%B'));
        }

        $chart = Charts::multi('line', 'highcharts')
            ->setColors(['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee','#55BF3B', '#DF5353', '#7798BF', '#aaeeee'])
            ->setTitle(null)
            ->setLabels($months)
            ->setElementLabel("Amount funded (R)")
            ->setDimensions(1000, 500)
            ->setResponsive(true);

        foreach ($funding_types as $key => $funding_type) {
            $chart->setDataset($key, $funding_type);
        }

        $fake_chart = Charts::multi('line', 'highcharts')
            ->setLabels(['May','June','July','August','September','October'])
            ->setDataset('Food', ['25678','28245','29658','25678','25678','23110'])
            ->setDataset('Housing', ['15321','18385','15995','9597','15355','16276'])
            ->setDataset('Transport', ['5020','6768','6892','7020','6923','5723'])
            ->setDataset('Data', ['200','225','300','400','600','750']);

        $parameters = [
            'chart' => $fake_chart,
        ];

        return view('reports.amountperfundingtype.index')->with($parameters);
    }

    public function actionsPerAdministrator()
    {
        $fake_chart = Charts::multi('line', 'highcharts')
            ->setLabels(['23 Oct','30 Oct','6 Nov','13 Nov','20 Nov','27 Nov'])
            ->setDataset('John Smith', ['32','34','29','31','32','23'])
            ->setDataset('Average', ['24','26','23','21','24','20'])
            ->setDataset('Mary Jane', ['4','5','8','0','1','2']);


        $parameters = [
            'chart' => $fake_chart,
        ];

        return view('reports.actionsperadministrator.index')->with($parameters);
    }
}

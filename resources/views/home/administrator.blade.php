@section('title') {{trans('string.home')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card-deck-wrapper">
            <div class="card-deck">
                @include('applications.dashboard')

                @include('donations.dashboard')

                @include('donationprofiles.dashboard')

                @include('donors.dashboard')
            </div>
        </div>

        <div class="card-deck-wrapper">
            <div class="card-deck">
                <div class="card">
                    <div class="card-block card-inverse card-dark">
                        <h2 class="card-title">Admin</h2>
                    </div>
                    <div class="card-block">
                        <ul>
                            <li><a href="{{route('administrators')}}">{{trans_choice('string.administrator',2)}}</a></li>
                            <li><a href="{{route('applicants')}}">{{trans_choice('string.applicant',2)}}</a></li>
                            <li><a href="{{route('fundingtypes')}}">{{trans_choice('string.funding_type',2)}}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-block card-inverse card-dark">
                        <h2 class="card-title">Reports</h2>
                    </div>
                    <div class="card-block">
                        <ul>
                            <li><a href="{{route('outstandingapplicants')}}">{{trans('string.outstanding_applicants')}}</a> {!! \App\Http\Controllers\ReportController::getOutstandingApplicantsDashboardString() !!}</li>
                            <li><a href="{{route('outstandingapplications')}}">{{trans('string.outstanding_applications')}}</a> {!! \App\Http\Controllers\ReportController::getOutstandingApplicationsDashboardString() !!}</li>
                            <li><a href="{{route('fundedperdegreetype')}}">{{trans('string.funding_type_performance')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

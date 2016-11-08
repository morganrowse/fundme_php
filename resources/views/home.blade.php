@section('title') {{trans('string.home')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-block card-inverse card-dark">
                <h2 class="card-title">@yield('title')</h2>
                <p>View system functions at a glance.</p>
            </div>
            <div class="card-block">
                <div class="col-lg-3">
                    @include('applicants.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('applications.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('donors.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('administrators.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('fundingtypes.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('donationprofiles.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('donations.dashboard')
                </div>
            </div>
            <div class="card-block card-inverse card-dark">
                <h2 class="card-title">{{trans_choice('string.report',2)}}</h2>
                <p>View system statistics and metrics.</p>
            </div>
            <hr>
            <div class="card-block">
                <div class="col-lg-3">
                    @include('reports.outstandingapplicants.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('reports.outstandingapplications.dashboard')
                </div>

                <div class="col-lg-3">
                    @include('reports.fundedperdegreetype.dashboard')
                </div>
        </div>
    </div>
@endsection

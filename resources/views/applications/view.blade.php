@section('title') {{trans('string.view_application')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">

                    <p>
                    <h4>{{trans_choice('string.applicant',1)}}: <a href="#">{{$application->applicant->user->first_name}}, {{$application->applicant->user->last_name}}</a></h4>
                    {{trans_choice('string.funding_type',1)}}: <strong><a href="#">{{$application->fundingType->name}}</a></strong>
                    <br>
                    {{trans('string.institution_name')}}: <strong>{{$application->institution_name}}</strong>
                    <br>
                    {{trans('string.degree_type')}}: <strong>{{$application->degree_type}}</strong>
                    <br>
                    {{trans('string.financial_means')}}: <strong>{{$application->financial_means}}</strong>

                    </p>

                    {!!$application->getFundedProgressBar()!!}
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th colspan="100%"><h3>{{trans_choice('string.donation',2)}}</h3></th>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>{{trans('string.first_name')}}</th>
                    <th>{{trans('string.last_name')}}</th>
                    <th>{{trans('string.organisation')}}</th>
                    <th class="text-right">{{trans('string.amount')}}</th>
                    <th class="text-right">{{trans('string.created_at')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($application->donations as $donation)
                    <tr>
                        <td>{{$donation->donationProfile->donor->first_name}}</td>
                        <td>{{$donation->donationProfile->donor->last_name}}</td>
                        <td>{{$donation->donationProfile->donor->organisation}}</td>
                        <td class="text-right">{{Fundme::getCurrency($donation->amount)}}</td>
                        <td class="text-right">{{$donation->created_at->diffForHumans()}}</td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="100%"><em>{{trans('string.no_data')}}</em></th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
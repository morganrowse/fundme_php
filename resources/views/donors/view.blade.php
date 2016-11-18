@section('title') {{trans('string.view_donor')}} @endsection

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
                    <h4>{{trans('string.name')}}: <strong>{{$donor->first_name}}, {{$donor->last_name}}</strong></h4>
                    {{trans('string.organisation')}}: <strong>{{$donor->organisation}}</strong>
                    <br>
                    {{trans('string.email')}}: <a href=""><strong>{{$donor->email}}</strong></a>
                    <br>
                    {{trans('string.address_line_1')}}: <strong>{{$donor->address_line_1}}</strong>
                    <br>
                    {{trans('string.address_line_2')}}: <strong>{{$donor->address_line_2}}</strong>
                    <br>
                    {{trans('string.address_line_3')}}: <strong>{{$donor->address_line_3}}</strong>
                    <br>
                    {{trans('string.address_line_4')}}: <strong>{{$donor->address_line_4}}</strong>
                    </p>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover">
                <thead>
                <tr>
                    <th colspan="100%"><h3>{{trans_choice('string.donation',2)}}</h3></th>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>{{trans('string.type')}}</th>
                    <th>{{trans_choice('string.funding_type',1)}}</th>
                    <th>{{trans('string.financial_means')}}</th>
                    <th class="text-right">{{trans('string.amount')}}</th>
                    <th class="text-right">{{trans('string.created')}}</th>
                    <th style="min-width: 165px">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donor->donationProfile()->orderBy('created_at','desc')->get() as $donation_profile)
                    <tr class="bg-primary">
                        <th>{{trans_choice('string.donation_profile',1)}}</th>
                        <th>{{$donation_profile->fundingType->name}}</th>
                        <th>{{$donation_profile->financial_means}}</th>
                        <th class="text-right">{{Fundme::getCurrency($donation_profile->maximum_amount)}} max</th>
                        <th class="text-right">{{$donation_profile->created_at->diffForHumans()}}</th>
                        <td>
                            {{Form::open(['route'=>array('donationprofiles/delete',$donation_profile->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('donationprofiles/edit',$donation_profile->id)}}" class="btn btn-warning">
                                        <i class="fa fa-pencil"></i> {{trans('string.edit')}}
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i> {{trans('string.delete')}}
                                    </button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </td>
                    </tr>
                    @forelse($donation_profile->donation()->with('application','application.fundingType')->orderBy('created_at','desc')->get() as $donation)
                        <tr>
                            <td><em>{{trans_choice('string.donation',1)}}</em></td>
                            <td><em>{{$donation->application->fundingType->name}}</em></td>
                            <td><em>{{$donation->application->financial_means}}</em></td>
                            <td class="text-right"><em>{{Fundme::getCurrency($donation->amount)}}</em></td>
                            <td class="text-right"><em>{{$donation->created_at->diffForHumans()}}</em></td>
                            <td>
                                {{Form::open(['route'=>array('donations/delete',$donation->id),'method'=>'POST'])}}
                                <div class="btn-toolbar">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('donations/edit',$donation->id)}}" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i> {{trans('string.edit')}}
                                        </a>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> {{trans('string.delete')}}
                                        </button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="100%"><em>No donations found.</em></th>
                        </tr>
                    @endforelse

                @empty
                    <tr>
                        <th colspan="100%"><em>No donation profiles found.</em></th>
                    </tr>
                    @endforelse
                    </tbody>
            </table>
        </div>
    </div>
@endsection
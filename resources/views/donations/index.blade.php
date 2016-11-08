@section('title') {{trans_choice('string.donation',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('donations/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_donation')}}</a>
            </div>
        </div>

    </div>

    <br>

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th>{{trans_choice('string.funding_type',1)}}</th>
                    <th>{{trans_choice('string.applicant',1)}}</th>
                    <th>{{trans_choice('string.donor',1)}}</th>
                    <th>{{trans('string.agreement')}}</th>
                    <th class="text-right">{{trans('string.amount')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th style="min-width: 165px">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <td>{{$donation->application->fundingType->name}}</td>
                        <td>{{$donation->application->applicant->user->first_name}}, {{$donation->application->applicant->user->last_name}} - {{$donation->application->institution_name}}</td>
                        <td>{{$donation->donationProfile->donor->first_name}}, {{$donation->donationProfile->donor->last_name}} - {{$donation->donationProfile->donor->organisation}}</td>
                        <td>@if($donation->agreement!=null)
                                <a class="btn btn-sm btn-primary" href='{{ action('FileController@getAgreement',$donation->agreement) }}' target="_blank">View attachment</a>
                            @else
                                <em>No attachment</em>
                            @endif
                        </td>
                        <td class="text-right">{{Fundme::getCurrency($donation->amount)}}</td>
                        <td class="text-right">{{$donation->updated_at->diffForHumans()}}</td>
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
                        <th colspan="100%"><em>{{trans('string.no_data')}}</em></th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

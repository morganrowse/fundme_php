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


    <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th></th>
                    <th>{{trans('string.funding')}}</th>
                    <th>{{trans_choice('string.donor',1)}}</th>
                    <th>File</th>
                    <th class="text-right">{{trans('string.amount')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th style="min-width: 165px">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donations as $donation)
                    <tr>
                        <td><a href="{{route('applicants/view',$donation->application->applicant->id)}}"><img src="{{action('FileController@getAvatar',$donation->application->applicant->user->getAvatarURL())}}" class="avatar-match"></a></td>
                        <td>{{$donation->application->fundingType->name}}</td>
                        <td><a href="{{route('donors/view',$donation->donationProfile->donor->id)}}" class="btn btn-sm btn-outline-primary">{{$donation->donationProfile->donor->first_name}}, {{$donation->donationProfile->donor->last_name}} - {{$donation->donationProfile->donor->organisation}}</a></td>
                        <td class="text-xs-center">
                            @if($donation->agreement!=null)
                                <a class="btn btn-sm btn-primary" href='{{ action('FileController@getAgreement',$donation->agreement) }}' target="_blank"><i class="fa fa-paperclip"></i></a>
                            @else
                                -
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

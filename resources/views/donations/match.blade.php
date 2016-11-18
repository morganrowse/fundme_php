@section('title') {{trans('string.match')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>

            <div class="card-block">

                {{Form::open(['action'=>'DonationController@match','method'=>'GET','class'=>'form-inline text-xs-center'])}}

                <div class="input-group input-group-sm">
                    <div class="input-group-addon">{{trans('string.funding')}}</div>
                    {{Form::select('funding_type',$funding_types,\Illuminate\Support\Facades\Input::get('funding_type'),['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                </div>

                <div class="input-group input-group-sm">
                    <div class="input-group-addon">{{trans('string.means')}}</div>
                    {{Form::select('financial_means',$financial_means,\Illuminate\Support\Facades\Input::get('financial_means'),['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                </div>

                <div class="input-group input-group-sm">
                    <div class="input-group-addon">{{trans('string.order')}}</div>
                    {{Form::select('order',$orders,\Illuminate\Support\Facades\Input::get('order'),['class'=>'form-control'])}}
                </div>

                <button class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-search"></i> {{trans('string.search')}}
                </button>

                <a href="{{route('donations/match')}}" class="btn btn-outline-danger btn-sm">
                    <i class="fa fa-remove"></i> {{trans('string.clear')}}
                </a>

                {{Form::close()}}
            </div>
        </div>


        @foreach($matches->chunk(3) as $chunk)

            <div class="card-deck-wrapper">
                <div class="card-deck">

                    @foreach($chunk as $match)
                        <div class="card">

                            <div class="card-header text-xs-center">
                                <h4><img src="{{action('FileController@getAvatar',$match->application->applicant->user->getAvatarURL())}}" class="avatar-match"/> {{$match->application->applicant->user->first_name}} {{$match->application->applicant->user->last_name}}</h4>
                            </div>

                            <div class="card-block card-block-description text-xs-center">
                                {{$match->application->fundingType->name}}[<b>{{$match->application->financial_means}}</b>]
                                {!! $match->application->getFundedProgressBar() !!}
                                <span class="tag tag-default">Available: R{{Fundme::getCurrency($match->donationProfile->getBalance())}}</span>
                            </div>

                            <div class="card-block card-block-description">
                                {{$match->application->degree_type}} @ {{$match->application->institution_name}}
                                <p class="card-match-created text-xs-right text-muted"><i class="fa fa-clock-o"></i> {{$match->application->created_at->diffforhumans()}}</p>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('donations/create',array('application'=>$match->application->id,'donation_profile'=>$match->donationProfile->id))}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> {{trans('string.match')}}
                                </a>

                                <a href="{{route('applications/view',$match->application->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-eye"></i> {{trans_choice('string.application',1)}}
                                </a>

                                <a href="{{route('donors/view',$match->donationProfile->donor->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-eye"></i> {{trans_choice('string.donor',1)}}
                                </a>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

        @endforeach

    </div>
@endsection

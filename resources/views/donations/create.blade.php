@section('title') {{trans('string.new_donation')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>'DonationController@handleCreate','method'=>'POST','files'=>true])}}

                    <div class="form-group row{{$errors->has('application') ? ' has-danger' : '' }}">
                        {{Form::label('application',trans_choice('string.application',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('application',$applications,old('application'),['class'=>'form-control','placeholder'=>trans('string.please_select'),'autofocus'])}}
                            @if($errors->has('application'))
                                <div class="form-control-feedback">{{$errors->first('application')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('donation_profile') ? ' has-danger' : '' }}">
                        {{Form::label('donation_profile',trans_choice('string.donation_profile',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('donation_profile',$donation_profiles,old('donation_profile'),['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                            @if($errors->has('donation_profile'))
                                <div class="form-control-feedback">{{$errors->first('donation_profile')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('amount') ? ' has-danger' : '' }}">
                        {{Form::label('amount',trans('string.amount'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {{trans('string.currency_symbol')}}
                                </span>
                                {{Form::number('amount',old('amount'),['class'=>'form-control','placeholder'=>trans('placeholder.amount'),'step'=>'0.01','min'=>'0.00'])}}
                            </div>
                            @if($errors->has('amount'))
                                <div class="form-control-feedback">{{$errors->first('amount')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('agreement') ? ' has-danger' : '' }}">
                        {{Form::label('agreement',trans('string.agreement'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-paperclip"></i>
                                </span>
                                {{Form::file('agreement',['class'=>'form-control','placeholder'=>trans('placeholder.agreement')])}}
                            </div>
                            @if($errors->has('agreement'))
                                <div class="form-control-feedback">{{$errors->first('agreement')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('donations')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                        {{Form::submit(trans('string.create'),['class'=>'btn btn-primary'])}}
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
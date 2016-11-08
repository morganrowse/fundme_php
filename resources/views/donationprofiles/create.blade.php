@section('title') {{trans('string.new_donation_profile')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>'DonationProfileController@handleCreate','method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('donor') ? ' has-danger' : '' }}">
                        {{Form::label('donor',trans_choice('string.donor',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('donor',$donors,old('donor'),['class'=>'form-control','placeholder'=>trans('string.please_select'),'autofocus'])}}
                            @if($errors->has('donor'))
                                <div class="form-control-feedback">{{$errors->first('donor')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('funding_type') ? ' has-danger' : '' }}">
                        {{Form::label('funding_type',trans_choice('string.funding_type',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('funding_type',$funding_types,old('funding_type'),['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                            @if($errors->has('funding_type'))
                                <div class="form-control-feedback">{{$errors->first('funding_type')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('financial_means') ? ' has-danger' : '' }}">
                        {{Form::label('financial_means',trans('string.financial_means'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('financial_means',$financial_means,old('financial_means'),['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                            @if($errors->has('financial_means'))
                                <div class="form-control-feedback">{{$errors->first('financial_means')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('maximum_amount') ? ' has-danger' : '' }}">
                        {{Form::label('maximum_amount',trans('string.maximum_amount'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {{trans('string.currency_symbol')}}
                                </span>
                                {{Form::number('maximum_amount',old('maximum_amount'),['class'=>'form-control','placeholder'=>trans('placeholder.amount'),'step'=>'0.01','min'=>'0.00'])}}
                            </div>
                            @if($errors->has('maximum_amount'))
                                <div class="form-control-feedback">{{$errors->first('maximum_amount')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('donationprofiles')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                        <button type="submit" class="btn btn-xs btn-primary">
                            <i class="fa fa-plus"></i> {{trans('string.create')}}
                        </button>
                    </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
@endsection
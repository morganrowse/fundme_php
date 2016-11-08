@section('title') {{trans('string.edit_application')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-warning">
            <div class="card-block card-inverse card-warning">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">

                    {{Form::open(['action'=>array('ApplicationController@handleEdit',$application->id),'method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('funding_type') ? ' has-danger' : '' }}">
                        {{Form::label('funding_type',trans_choice('string.funding_type',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('funding_type',$funding_types,$application->funding_type_id,['class'=>'form-control','placeholder'=>trans('string.please_select'),'autofocus'])}}
                            @if($errors->has('funding_type'))
                                <div class="form-control-feedback">{{$errors->first('funding_type')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('institution_name') ? ' has-danger' : '' }}">
                        {{Form::label('institution_name',trans('string.institution_name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('institution_name',$application->institution_name,['class'=>'form-control','placeholder'=>trans('placeholder.institution_name')])}}
                            @if($errors->has('institution_name'))
                                <div class="form-control-feedback">{{$errors->first('institution_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('degree_type') ? ' has-danger' : '' }}">
                        {{Form::label('degree_type',trans('string.degree_type'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('degree_type',$application->degree_type,['class'=>'form-control','placeholder'=>trans('placeholder.degree_type')])}}
                            @if($errors->has('degree_type'))
                                <div class="form-control-feedback">{{$errors->first('degree_type')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('financial_means') ? ' has-danger' : '' }}">
                        {{Form::label('financial_means',trans('string.financial_means'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('financial_means',$financial_means,$application->financial_means,['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                            @if($errors->has('financial_means'))
                                <div class="form-control-feedback">{{$errors->first('financial_means')}}</div>
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
                                {{Form::number('amount',Fundme::getCurrency($application->amount),['class'=>'form-control','placeholder'=>trans('placeholder.amount'),'step'=>'0.01','min'=>'0.00'])}}
                            </div>
                            @if($errors->has('amount'))
                                <div class="form-control-feedback">{{$errors->first('amount')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('applications')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                        <button type="submit" class="btn btn-xs btn-warning">
                            <i class="fa fa-pencil"></i> {{trans('string.edit')}}
                        </button>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
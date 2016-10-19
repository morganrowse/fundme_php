@section('title') {{trans('string.edit_donor')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1>@yield('title')</h1>

            <hr>

            <div class="panel panel-warning">
                <div class="panel-heading"></div>
                <div class="panel-body">

                    {{Form::open(['action'=>array('DonorController@handleEdit',$donor->id),'method'=>'POST','class'=>'form-horizontal','role'=>'form'])}}

                    <div class="form-group{{ $errors->has('funding_type') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('funding_type',trans_choice('string.funding_type',1),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::select('funding_type',$funding_types,$application->funding_type_id,['class'=>'form-control','autofocus','placeholder'=>trans('string.please_select')])}}
                            @if ($errors->has('funding_type'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('funding_type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('institution_name') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('institution_name',trans('string.institution_name'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('institution_name',$application->institution_name,['class'=>'form-control','placeholder'=>trans('placeholder.institution_name')])}}
                            @if ($errors->has('institution_name'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('institution_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('degree_type') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('degree_type',trans('string.degree_type'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('degree_type',$application->degree_type,['class'=>'form-control','placeholder'=>trans('placeholder.degree_type')])}}
                            @if ($errors->has('degree_type'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('degree_type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('financial_means') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('financial_means',trans('string.financial_means'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::select('financial_means',$financial_means,$application->financial_means,['class'=>'form-control','placeholder'=>trans('string.please_select')])}}
                            @if ($errors->has('financial_means'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('financial_means') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('amount') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('amount',trans('string.amount'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">{{trans('string.currency_symbol')}}</div>
                                {{Form::number('amount',App\Fundme::getCurrency($application->amount),['class'=>'form-control','placeholder'=>'0.00','min'=>'0','step'=>'0.01'])}}
                            </div>
                            @if ($errors->has('amount'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <hr>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{route('donors')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                            {{Form::submit(trans('string.edit'),['class'=>'btn btn-warning'])}}
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') {{trans('string.edit_application')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1>@yield('title')</h1>

            <hr>

            <div class="panel panel-warning">
                <div class="panel-heading"></div>
                <div class="panel-body">

                    {{Form::open(['action'=>array('ApplicantController@handleEdit',$applicant->id),'method'=>'POST','class'=>'form-horizontal','role'=>'form'])}}

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('first_name',trans('string.first_name'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('first_name',$applicant->user->first_name,['class'=>'form-control','placeholder'=>trans('placeholder.first_name'),'autofocus'])}}
                            @if ($errors->has('first_name'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('last_name',trans('string.last_name'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('last_name',$applicant->user->last_name,['class'=>'form-control','placeholder'=>trans('placeholder.last_name')])}}
                            @if ($errors->has('last_name'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('student_number') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('student_number',trans('string.student_number'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('student_number',$applicant->student_number,['class'=>'form-control','placeholder'=>trans('placeholder.student_number')])}}
                            @if ($errors->has('student_number'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('student_number') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('email',trans('string.email'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('email',$applicant->user->email,['class'=>'form-control','placeholder'=>trans('placeholder.email')])}}
                            @if ($errors->has('email'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cellphone') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('cellphone',trans('string.cellphone'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('cellphone',$applicant->cellphone,['class'=>'form-control','placeholder'=>trans('placeholder.cellphone')])}}
                            @if ($errors->has('cellphone'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group{{ $errors->has('address_line_1') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('address_line_1',trans('string.address_line_1'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('address_line_1',$applicant->address_line_1,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_1')])}}
                            @if ($errors->has('address_line_1'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address_line_2') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('address_line_2',trans('string.address_line_2'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('address_line_2',$applicant->address_line_2,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_2')])}}
                            @if ($errors->has('address_line_2'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address_line_3') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('address_line_3',trans('string.address_line_3'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('address_line_3',$applicant->address_line_3,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_3')])}}
                            @if ($errors->has('address_line_3'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_3') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address_line_4') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('address_line_4',trans('string.address_line_4'),['class'=>'col-md-4 control-label'])}}
                        <div class="col-md-6">
                            {{Form::text('address_line_4',$applicant->address_line_4,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_4')])}}
                            @if ($errors->has('address_line_4'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">
                                        <strong>{{ $errors->first('address_line_4') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{route('applicants')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                            {{Form::submit(trans('string.edit'),['class'=>'btn btn-warning'])}}
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

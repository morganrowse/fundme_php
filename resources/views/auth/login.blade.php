@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('string.login')}}</div>
                    <div class="panel-body">
                        {{Form::open(['action'=>'Auth\LoginController@handleLogin','method'=>'POST','class'=>'form-horizontal','role'=>'form'])}}

                        <div class="form-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                            {{Form::label('email',trans('string.email'),['class'=>'col-md-4 control-label'])}}
                            <div class="col-md-6">
                                {{Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('placeholder.email'),'autofocus'])}}
                                @if ($errors->has('email'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                            {{Form::label('password',trans('string.password'),['class'=>'col-md-4 control-label'])}}
                            <div class="col-md-6">
                                {{Form::password('password',['class'=>'form-control','placeholder'=>trans('placeholder.password')])}}
                                @if ($errors->has('password'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('','',['class'=>'col-md-4 control-label'])}}
                            <div class="col-md-6">
                                <div class="checkbox">
                                    {{Form::checkbox('remember','true',false,['id'=>'remember'])}}
                                    <label for="remember">
                                        {{trans('string.remember_me')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{Form::submit(trans('string.login'),['class'=>'btn btn-primary'])}}
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


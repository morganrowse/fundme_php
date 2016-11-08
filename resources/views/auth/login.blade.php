@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">{{trans('string.login')}}</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-6 offset-lg-3">
                    {{Form::open(['action'=>'Auth\LoginController@handleLogin','method'=>'POST'])}}
                    {{Form::hidden('_token',csrf_token())}}

                    <div class="form-group row{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('email',trans('string.email'),['class'=>'col-lg-2 col-form-label'])}}
                        <div class="col-lg-10">
                            {{Form::email('email',old('email'),['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.email'),'autofocus'])}}
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('password',trans('string.password'),['class'=>'col-lg-2 col-form-label'])}}
                        <div class="col-lg-10">
                            {{Form::password('password',['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.password')])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('','',['class'=>'col-lg-2 col-form-label'])}}
                        <div class="col-lg-10">
                            <div class="form-check">
                                <label class="form-check-label">
                                    {{Form::checkbox('remember','true',false,['id'=>'remember'])}}
                                    {{trans('string.remember_me')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::submit(trans('string.login'),['class'=>'btn btn-primary col-lg-10 offset-lg-2'])}}
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
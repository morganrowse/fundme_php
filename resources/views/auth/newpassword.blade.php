@section('title') {{trans('string.change_password')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-6 offset-lg-3">
                    {{Form::open(['action'=>array('UserController@handleNewPassword',Auth::user()->id),'method'=>'POST'])}}
                    {{Form::hidden('_token',csrf_token())}}

                    <div class="form-group row{{ $errors->has('old_password') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('old_password',trans('string.old_password'),['class'=>'col-lg-3 col-form-label'])}}
                        <div class="col-lg-9">
                            {{Form::password('old_password',['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.password')])}}
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('password',trans('string.password'),['class'=>'col-lg-3 col-form-label'])}}
                        <div class="col-lg-9">
                            {{Form::password('password',['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.password')])}}
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('password_confirmation',trans('string.password_confirmation'),['class'=>'col-lg-3 col-form-label'])}}
                        <div class="col-lg-9">
                            {{Form::password('password_confirmation',['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.password_confirmation')])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::submit(trans('string.change'),['class'=>'btn btn-primary col-lg-9 offset-lg-3'])}}
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
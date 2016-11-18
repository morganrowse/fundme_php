@section('title') {{trans('string.change_avatar')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-6 offset-lg-3">
                    {{Form::open(['action'=>array('UserController@handleAvatar',Auth::user()->id),'method'=>'POST','files'=>true])}}
                    {{Form::hidden('_token',csrf_token())}}

                    <div class="form-group row{{ $errors->has('avatar') ? ' has-error has-feedback' : '' }}">
                        {{Form::label('avatar',trans('string.avatar'),['class'=>'col-lg-3 col-form-label'])}}
                        <div class="col-lg-9">
                            {{Form::file('avatar',['class'=>'form-control form-control-success','placeholder'=>trans('placeholder.avatar')])}}
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
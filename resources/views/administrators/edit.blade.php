@section('title') {{trans('string.edit_administrator')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-warning">
            <div class="card-block card-inverse card-warning">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>array('AdministratorController@handleEdit',$administrator->id),'method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('first_name') ? ' has-danger' : '' }}">
                        {{Form::label('first_name',trans('string.first_name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('first_name',$administrator->user->first_name,['class'=>'form-control','placeholder'=>trans('placeholder.first_name'),'autofocus'])}}
                            @if($errors->has('first_name'))
                                <div class="form-control-feedback">{{$errors->first('first_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('last_name') ? ' has-danger' : '' }}">
                        {{Form::label('last_name',trans('string.last_name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('last_name',$administrator->user->last_name,['class'=>'form-control','placeholder'=>trans('placeholder.last_name')])}}
                            @if($errors->has('last_name'))
                                <div class="form-control-feedback">{{$errors->first('last_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('email') ? ' has-danger' : '' }}">
                        {{Form::label('email',trans('string.email'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::email('email',$administrator->user->email,['class'=>'form-control','placeholder'=>trans('placeholder.email')])}}
                            @if($errors->has('email'))
                                <div class="form-control-feedback">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('administrators')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
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
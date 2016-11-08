@section('title') {{trans('string.new_funding_type')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>'FundingTypeController@handleCreate','method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('name') ? ' has-danger' : '' }}">
                        {{Form::label('name',trans('string.name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('placeholder.name'),'autofocus'])}}
                            @if($errors->has('name'))
                                <div class="form-control-feedback">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                            <a href="{{route('fundingtypes')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                        <button type="submit" class="btn btn-xs btn-primary">
                            <i class="fa fa-plus"></i> {{trans('string.create')}}
                        </button>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title') {{trans('string.edit_funding_type')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-warning">
            <div class="card-block card-inverse card-warning">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>array('FundingTypeController@handleEdit',$funding_type->id),'method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('name') ? ' has-danger' : '' }}">
                        {{Form::label('name',trans('string.name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('name',$funding_type->name,['class'=>'form-control','placeholder'=>trans('placeholder.name'),'autofocus'])}}
                            @if($errors->has('name'))
                                <div class="form-control-feedback">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('fundingtypes')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
                        <button type="submit" class="btn btn-xs btn-warning">
                            <i class="fa fa-pencil"></i> {{trans('string.edit')}}
                        </button>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection

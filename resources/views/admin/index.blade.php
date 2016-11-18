@section('title') {{trans('string.admin')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-block card-inverse card-dark">
                <h2 class="card-title">Admin</h2>
            </div>

        </div>
            <div class="card card-outline-secondary">
                <div class="card-block">
                    <h3>{{trans('string.create')}}</h3>

                    {{Form::open(['action'=>array('AdminController@handleApplicants',Auth::user()->userable->id),'method'=>'POST','files'=>true])}}
                    <div class="input-group">
                        <span class="input-group-addon">{{trans_choice('string.applicant',2)}}</span>
                        {{Form::number('applicant',10,['class'=>'form-control'])}}
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> {{trans('string.create')}}
                        </button>
                    </span>
                    </div>
                    {{Form::close()}}

                    <br>

                    {{Form::open(['action'=>array('ApplicantController@handleDocumentation',Auth::user()->userable->id),'method'=>'POST','files'=>true])}}
                    <div class="input-group">
                        <span class="input-group-addon">{{trans_choice('string.application',2)}}</span>
                        {{Form::number('applicant',10,['class'=>'form-control'])}}
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> {{trans('string.create')}}
                        </button>
                    </span>
                    </div>
                    {{Form::close()}}
                </div>
            </div>

    </div>
@endsection

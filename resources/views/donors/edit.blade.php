@section('title') {{trans('string.edit_donor')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-warning">
            <div class="card-block card-inverse card-warning">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">
                    {{Form::open(['action'=>array('DonorController@handleEdit',$donor->id),'method'=>'POST'])}}

                    <div class="form-group row{{$errors->has('administrator') ? ' has-danger' : '' }}">
                        {{Form::label('administrator',trans_choice('string.administrator',1),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::select('administrator',$administrators,$donor->administrator_id,['class'=>'form-control','placeholder'=>trans('string.please_select'),'autofocus'])}}
                            @if($errors->has('administrator'))
                                <div class="form-control-feedback">{{$errors->first('administrator')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('first_name') ? ' has-danger' : '' }}">
                        {{Form::label('first_name',trans('string.first_name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('first_name',$donor->first_name,['class'=>'form-control','placeholder'=>trans('placeholder.first_name')])}}
                            @if($errors->has('first_name'))
                                <div class="form-control-feedback">{{$errors->first('first_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('last_name') ? ' has-danger' : '' }}">
                        {{Form::label('last_name',trans('string.last_name'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('last_name',$donor->last_name,['class'=>'form-control','placeholder'=>trans('placeholder.last_name')])}}
                            @if($errors->has('last_name'))
                                <div class="form-control-feedback">{{$errors->first('last_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('organisation') ? ' has-danger' : '' }}">
                        {{Form::label('organisation',trans('string.organisation'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('organisation',$donor->organisation,['class'=>'form-control','placeholder'=>trans('placeholder.organisation')])}}
                            @if($errors->has('organisation'))
                                <div class="form-control-feedback">{{$errors->first('organisation')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('email') ? ' has-danger' : '' }}">
                        {{Form::label('email',trans('string.email'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::email('email',$donor->email,['class'=>'form-control','placeholder'=>trans('placeholder.email')])}}
                            @if($errors->has('email'))
                                <div class="form-control-feedback">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row{{$errors->has('address_line_1') ? ' has-danger' : '' }}">
                        {{Form::label('address_line_1',trans('string.address_line_1'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('address_line_1',$donor->address_line_1,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_1')])}}
                            @if($errors->has('address_line_1'))
                                <div class="form-control-feedback">{{$errors->first('address_line_1')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('address_line_2') ? ' has-danger' : '' }}">
                        {{Form::label('address_line_2',trans('string.address_line_2'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('address_line_2',$donor->address_line_2,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_2')])}}
                            @if($errors->has('address_line_2'))
                                <div class="form-control-feedback">{{$errors->first('address_line_2')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('address_line_3') ? ' has-danger' : '' }}">
                        {{Form::label('address_line_3',trans('string.address_line_3'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('address_line_3',$donor->address_line_3,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_3')])}}
                            @if($errors->has('address_line_3'))
                                <div class="form-control-feedback">{{$errors->first('address_line_3')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{$errors->has('address_line_4') ? ' has-danger' : '' }}">
                        {{Form::label('address_line_4',trans('string.address_line_4'),['class'=>'col-lg-4 col-form-label'])}}
                        <div class="col-lg-8">
                            {{Form::text('address_line_4',$donor->address_line_4,['class'=>'form-control','placeholder'=>trans('placeholder.address_line_4')])}}
                            @if($errors->has('address_line_4'))
                                <div class="form-control-feedback">{{$errors->first('address_line_4')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="{{route('donors')}}" class="btn btn-default">{{trans('string.cancel')}}</a>
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
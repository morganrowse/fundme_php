@section('title') {{trans_choice('string.applicant',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1>@yield('title')</h1>

            <hr>

            <a href="{{route('applicants/create')}}" class="btn btn-primary">{{trans('string.new_applicant')}}</a>

            <br>
            <br>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{trans('string.first_name')}}</th>
                    <th>{{trans('string.last_name')}}</th>
                    <th>{{trans('string.email')}}</th>
                    <th>{{trans('string.cellphone')}}</th>
                    <th>{{trans('string.student_number')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th>{{trans('string.status')}}</th>
                    <th>{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applicants as $applicant)
                    <tr>
                        <td>{{$applicant->user->first_name}}</td>
                        <td>{{$applicant->user->last_name}}</td>
                        <td>{{$applicant->user->email}}</td>
                        <td>{{$applicant->cellphone}}</td>
                        <td>{{$applicant->student_number}}</td>
                        <td class="text-right">{{$applicant->updated_at->diffForHumans()}}</td>
                        <td>{!!$applicant->getStatusLabel()!!}</td>
                        <td>
                            <a href="{{route('applicants/edit',$applicant->id)}}" class="btn btn-xs btn-warning">
                                {{trans('string.edit')}}
                            </a>
                            <div style="float: right; clear: both">
                                {{Form::open(['route'=>array('applicants/delete',$applicant->id),'method'=>'POST'])}}
                                {{Form::submit(trans('string.delete'),['class'=>'btn btn-xs btn-danger'])}}
                                {{Form::close()}}
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <th colspan="100%"><em>{{trans('string.no_data')}}</em></th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

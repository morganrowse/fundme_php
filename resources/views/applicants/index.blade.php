@section('title') {{trans_choice('string.applicant',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('applicants/create')}}" class="btn btn-success">{{trans('string.new_applicant')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover">
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
                        <td style="min-width: 140px">
                            {{Form::open(['route'=>array('applicants/delete',$applicant->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('applicants/edit',$applicant->id)}}" class="btn btn-warning">
                                        {{trans('string.edit')}}
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    {{Form::submit(trans('string.delete'),['class'=>'btn btn-xs btn-danger'])}}
                                </div>
                            </div>
                            {{Form::close()}}
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

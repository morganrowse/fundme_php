@section('title') {{trans('string.outstanding_applicants')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <p>This report shows all applicants older than 3 months that have not uploaded documentation.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th></th>
                    <th class="text-right">{{trans('string.created')}}</th>
                    <th>{{trans('string.name')}}</th>
                    <th>{{trans('string.surname')}}</th>
                    <th>{{trans('string.email')}}</th>
                    <th>{{trans('string.cellphone')}}</th>
                    <th>{{trans('string.student#')}}</th>
                    <th>{{trans('string.status')}}</th>
                    <th>{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applicants as $applicant)
                    <tr>
                        <td><a href="{{route('applicants/view',$applicant->id)}}"><img src="{{action('FileController@getAvatar',$applicant->user->getAvatarURL())}}" class="avatar-match"></a></td>
                        <td class="text-right">{{$applicant->created_at->diffForHumans()}}</td>
                        <td>{{$applicant->user->first_name}}</td>
                        <td>{{$applicant->user->last_name}}</td>
                        <td>{{$applicant->user->email}}</td>
                        <td>{{$applicant->cellphone}}</td>
                        <td>{{$applicant->student_number}}</td>
                        <td>{!!$applicant->getStatusLabel()!!}</td>
                        <td style="min-width: 165px">
                            {{Form::open(['route'=>array('applicants/delete',$applicant->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('applicants/edit',$applicant->id)}}" class="btn btn-warning">
                                        <i class="fa fa-pencil"></i> {{trans('string.edit')}}
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i> {{trans('string.delete')}}
                                    </button>
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

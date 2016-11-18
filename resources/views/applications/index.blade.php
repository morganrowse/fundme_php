@section('title') {{trans_choice('string.application',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('applications/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_application')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">

            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th></th>
                    <th>{{trans('string.funding')}}</th>
                    <th>{{trans('string.means')}}</th>
                    <th>{{trans('string.degree')}}</th>
                    <th>{{trans('string.institution')}}</th>
                    <th class="text-xs-center">{{trans('string.amount')}}</th>
                    <th class="text-xs-right">{{trans('string.updated')}}</th>
                    <th class="button-3-group">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td><a href="{{route('applicants/view',$application->applicant->id)}}"><img src="{{action('FileController@getAvatar',$application->applicant->user->getAvatarURL())}}" class="avatar-match"></a></td>
                        <td>{{$application->fundingType->name}}</td>
                        <td>{{$application->financial_means}}</td>
                        <td>{{$application->degree_type}}</td>
                        <td>{{$application->institution_name}}</td>
                        <td>{!! $application->getFundedProgressBar() !!}</td>
                        <td class="text-xs-right">{{$application->updated_at->diffForHumans()}}</td>
                        <td>
                            {{Form::open(['route'=>array('applications/delete',$application->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('applications/view',$application->id)}}" class="btn btn-primary">
                                        <i class="fa fa-eye"></i> {{trans('string.view')}}
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('applications/edit',$application->id)}}" class="btn btn-warning">
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

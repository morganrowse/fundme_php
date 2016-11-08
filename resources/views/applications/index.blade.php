@section('title') {{trans_choice('string.application',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('applications/create')}}" class="btn btn-success">{{trans('string.new_application')}}</a>
            </div>
        </div>

    </div>

    <br>

    <div class="container-fluid">

    <div class="table-responsive">
        <table class="table table-inverse table-striped table-hover">
            <thead>
            <tr>
                <th>{{trans_choice('string.funding_type',1)}}</th>
                <th>{{trans('string.institution_name')}}</th>
                <th>{{trans('string.degree_type')}}</th>
                <th>{{trans('string.financial_means')}}</th>
                <th>{{trans('string.amount')}}</th>
                <th class="text-right">{{trans('string.updated')}}</th>
                <th>{{trans('string.status')}}</th>
                <th>{{trans('string.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{$application->fundingType->name}}</td>
                    <td>{{$application->institution_name}}</td>
                    <td>{{$application->degree_type}}</td>
                    <td>{{$application->financial_means}}</td>
                    <td>{!! $application->getFundedProgressBar() !!}</td>
                    <td class="text-right">{{$application->updated_at->diffForHumans()}}</td>
                    <td>{!!$application->getStatusLabel()!!}</td>
                    <td style="min-width: 190px">
                        {{Form::open(['route'=>array('applications/delete',$application->id),'method'=>'POST'])}}
                        <div class="btn-toolbar">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('applications/view',$application->id)}}" class="btn btn-primary">
                                    {{trans('string.view')}}
                                </a>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('applications/edit',$application->id)}}" class="btn btn-warning">
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

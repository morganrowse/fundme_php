@section('title') {{trans('string.outstanding_applications')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <p>This report shows all applications older than 3 months that have received less than 10% funding.</p>
            </div>
        </div>

    </div>

    <br>

    <div class="container-fluid">

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th>{{trans('string.created')}}</th>
                    <th>{{trans_choice('string.funding_type',1)}}</th>
                    <th>{{trans('string.institution_name')}}</th>
                    <th>{{trans('string.degree_type')}}</th>
                    <th>{{trans('string.financial_means')}}</th>
                    <th style="min-width: 220px">{{trans('string.amount')}}</th>
                    <th>{{trans('string.status')}}</th>
                    <th style="min-width: 236px">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{$application->created_at->diffForHumans()}}</td>
                        <td>{{$application->fundingType->name}}</td>
                        <td>{{$application->institution_name}}</td>
                        <td>{{$application->degree_type}}</td>
                        <td>{{$application->financial_means}}</td>
                        <td>{!! $application->getFundedProgressBar() !!}</td>
                        <td>{!!$application->getStatusLabel()!!}</td>
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
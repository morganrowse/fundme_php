@section('title') {{trans_choice('string.application',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1>@yield('title')</h1>

            <hr>

            <a href="{{route('applications/create')}}" class="btn btn-primary">{{trans('string.new_application')}}</a>

            <br>
            <br>

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{trans_choice('string.funding_type',1)}}</th>
                    <th>{{trans('string.institution_name')}}</th>
                    <th>{{trans('string.degree_type')}}</th>
                    <th>{{trans('string.financial_means')}}</th>
                    <th class="text-right">{{trans('string.amount')}}</th>
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
                        <td class="text-right">{{App\Fundme::getCurrency($application->amount)}}</td>
                        <td class="text-right">{{$application->updated_at->diffForHumans()}}</td>
                        <td>{!!$application->getStatusLabel()!!}</td>
                        <td>
                            <a href="{{route('applications/edit',$application->id)}}" class="btn btn-xs btn-warning">
                                {{trans('string.edit')}}
                            </a>
                            <div style="float: right; clear: both">
                                {{Form::open(['route'=>array('applications/delete',$application->id),'method'=>'POST'])}}
                                {{Form::submit(trans('string.delete'),['class'=>'btn btn-xs btn-danger'])}}
                                {{Form::close()}}
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <th><em>{{trans('string.no_data')}}</em></th>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('title') {{trans_choice('string.donor',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <h1>@yield('title')</h1>

            <hr>

            <a href="{{route('donors/create')}}" class="btn btn-primary">{{trans('string.new_donor')}}</a>

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
                @forelse($donors as $donor)
                    <tr>
                        <td>{{$donor->name}}</td>
                        <td class="text-right">{{$donor->updated_at->diffForHumans()}}</td>
                        <td>{!!$donor->getStatusLabel()!!}</td>
                        <td>
                            <a href="{{route('donors/edit',$donor->id)}}" class="btn btn-xs btn-warning">
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
                        <th colspan="100%"><em>{{trans('string.no_data')}}</em></th>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('title') {{trans_choice('string.funding_type',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('fundingtypes/create')}}" class="btn btn-success">{{trans('string.new_funding_type')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover">
                <thead>
                <tr>
                    <th>{{trans('string.name')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th>{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($funding_types as $funding_type)
                    <tr>
                        <td>{{$funding_type->name}}</td>
                        <td class="text-right">{{$funding_type->updated_at->diffForHumans()}}</td>
                        <td style="min-width: 140px">
                            {{Form::open(['route'=>array('fundingtypes/delete',$funding_type->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('fundingtypes/edit',$funding_type->id)}}" class="btn btn-warning">
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

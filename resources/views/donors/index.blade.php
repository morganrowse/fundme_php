@section('title') {{trans_choice('string.donor',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('donors/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_donor')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th>{{trans('string.name')}}</th>
                    <th>{{trans('string.surname')}}</th>
                    <th>{{trans('string.email')}}</th>
                    <th>{{trans('string.organisation')}}</th>
                    <th>{{trans_choice('string.administrator',1)}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th style="min-width: 236px">{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donors as $donor)
                    <tr>
                        <td>{{$donor->first_name}}</td>
                        <td>{{$donor->last_name}}</td>
                        <td>{{$donor->email}}</td>
                        <td>{{$donor->organisation}}</td>
                        <td>{{$donor->administrator->user->first_name}}, {{$donor->administrator->user->last_name}}</td>
                        <td class="text-right">{{$donor->updated_at->diffForHumans()}}</td>
                        <td>
                            {{Form::open(['route'=>array('donors/delete',$donor->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('donors/view',$donor->id)}}" class="btn btn-primary">
                                        <i class="fa fa-eye"></i> {{trans('string.view')}}
                                    </a>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('donors/edit',$donor->id)}}" class="btn btn-warning">
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

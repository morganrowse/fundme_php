@section('title') {{trans_choice('string.administrator',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('administrators/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_administrator')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover" id="main-table">
                <thead>
                <tr>
                    <th></th>
                    <th>{{trans('string.name')}}</th>
                    <th>{{trans('string.surname')}}</th>
                    <th>{{trans('string.email')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th>{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($administrators as $administrator)
                    <tr>
                        <td><img src="{{action('FileController@getAvatar',$administrator->user->getAvatarURL())}}" class="avatar-match"></td>
                        <td>{{$administrator->user->first_name}}</td>
                        <td>{{$administrator->user->last_name}}</td>
                        <td>{{$administrator->user->email}}</td>
                        <td class="text-right">{{$administrator->updated_at->diffForHumans()}}</td>
                        <td style="min-width: 165px">
                            {{Form::open(['route'=>array('administrators/delete',$administrator->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('administrators/edit',$administrator->id)}}" class="btn btn-warning">
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

@section('title') {{trans_choice('string.donation_profile',2)}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <a href="{{route('donationprofiles/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_donation_profile')}}</a>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-inverse table-striped table-hover">
                <thead>
                <tr>
                    <th>{{trans_choice('string.donor',1)}}</th>
                    <th>{{trans_choice('string.funding_type',1)}}</th>
                    <th>{{trans_choice('string.financial_means',1)}}</th>
                    <th class="text-right">{{trans('string.maximum_amount')}}</th>
                    <th class="text-right">{{trans('string.updated')}}</th>
                    <th>{{trans('string.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donation_profiles as $donation_profile)
                    <tr>
                        <td>{{$donation_profile->donor->first_name}}</td>
                        <td>{{$donation_profile->fundingType->name}}</td>
                        <td>{{$donation_profile->financial_means}}</td>
                        <td>{{Fundme::getCurrency($donation_profile->maximum_amount)}}</td>
                        <td class="text-right">{{$donation_profile->updated_at->diffForHumans()}}</td>
                        <td style="min-width: 165px">
                            {{Form::open(['route'=>array('donationprofiles/delete',$donation_profile->id),'method'=>'POST'])}}
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('donationprofiles/edit',$donation_profile->id)}}" class="btn btn-warning">
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

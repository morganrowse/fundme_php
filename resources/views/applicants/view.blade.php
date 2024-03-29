@section('title') {{trans('string.view_applicant')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>


            <div class="card-block">
                <div class="col-lg-8 offset-lg-2">

                    <div class="avatar-main-div">
                        <img src="{{action('FileController@getAvatar',$applicant->user->getAvatarURL())}}" class="fa avatar-main">
                    </div>

                    <div class="applicant-header">
                        <h1>{{$applicant->user->first_name}} {{$applicant->user->last_name}}</h1>
                        <p>
                            {!! $applicant->user->userable->getStatusLabel() !!}
                            Joined {{$applicant->created_at->diffforhumans()}}
                        </p>
                    </div>

                    <p>
                        <br>
                        {{trans('string.email')}}: <a href=""><strong>{{$applicant->user->email}}</strong></a>
                        <br>
                        {{trans('string.cellphone')}}: <strong>{{$applicant->cellphone}}</strong>
                        <br>
                        {{trans('string.student_number')}}: <strong>{{$applicant->student_number}}</strong>
                        <br>
                        {{trans('string.address_line_1')}}: <strong>{{$applicant->address_line_1}}</strong>
                        <br>
                        {{trans('string.address_line_2')}}: <strong>{{$applicant->address_line_2}}</strong>
                        <br>
                        {{trans('string.address_line_3')}}: <strong>{{$applicant->address_line_3}}</strong>
                        <br>
                        {{trans('string.address_line_4')}}: <strong>{{$applicant->address_line_4}}</strong>
                    </p>

                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-tabs-profile hidden" id="nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#applications">{{trans_choice('string.application',2)}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#donations">{{trans_choice('string.donation',2)}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#profile">{{trans('string.profile')}}</a>
            </li>
        </ul>

        <div class="tab-content hidden">
            <div class="tab-pane active" id="applications">
                <div class="table-responsive">

                    <table class="table table-inverse table-striped table-hover">
                        <thead>
                        <tr>

                            <td colspan="100%">
                                @if(Auth::user()->userable_type=='App\Administrator')
                                    <a href="{{route('applications/create',array('applicant'=>$applicant->id))}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_application')}}</a>
                                @else
                                    <a href="{{route('applications/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_application')}}</a>
                                @endif
                                <br><br>
                            </td>
                        </tr>
                        <tr>
                            <th>{{trans('string.funding')}}</th>
                            <th>{{trans('string.institution')}}</th>
                            <th>{{trans('string.degree')}}</th>
                            <th>{{trans('string.means')}}</th>
                            <th>{{trans('string.amount')}}</th>
                            <th class="text-right">{{trans('string.updated')}}</th>
                            <th class="button-3-group">{{trans('string.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($applicant->applications()->with('fundingType')->orderBy('updated_at','desc')->get() as $application)
                            <tr>
                                <td>{{$application->fundingType->name}}</td>
                                <td>{{$application->institution_name}}</td>
                                <td>{{$application->degree_type}}</td>
                                <td>{{$application->financial_means}}</td>
                                <td>{!! $application->getFundedProgressBar() !!}</td>
                                <td class="text-right">{{$application->updated_at->diffForHumans()}}</td>
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
            <div class="tab-pane" id="donations">
                <div class="table-responsive">
                    <table class="table table-inverse table-striped table-hover">
                        <thead>
                        <tr>
                            <td colspan="100%"><a href="{{route('donations/create')}}" class="btn btn-success"><i class="fa fa-plus"></i> {{trans('string.new_donation')}}</a><br><br></td>
                        </tr>
                        <tr>
                            <th>{{trans('string.funding')}}</th>
                            <th>{{trans_choice('string.donor',1)}}</th>
                            <th>{{trans('string.agreement')}}</th>
                            <th class="text-right">{{trans('string.amount')}}</th>
                            <th class="text-right">{{trans('string.updated')}}</th>
                            <th style="min-width: 165px">{{trans('string.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($applicant->donations()->with('donationProfile','donationProfile.donor','application.fundingType')->orderBy('updated_at','desc')->get() as $donation)
                            <tr>
                                <td>{{$donation->application->fundingType->name}}</td>
                                <td>{{$donation->donationProfile->donor->first_name}}, {{$donation->donationProfile->donor->last_name}} - {{$donation->donationProfile->donor->organisation}}</td>
                                <td>@if($donation->agreement!=null)
                                        <a class="btn btn-sm btn-primary" href='{{ action('FileController@getAgreement',$donation->agreement) }}' target="_blank">View attachment</a>
                                    @else
                                        <em>No attachment</em>
                                    @endif
                                </td>
                                <td class="text-right">{{Fundme::getCurrency($donation->amount)}}</td>
                                <td class="text-right">{{$donation->updated_at->diffForHumans()}}</td>
                                <td>
                                    {{Form::open(['route'=>array('donations/delete',$donation->id),'method'=>'POST'])}}
                                    <div class="btn-toolbar">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{route('donations/edit',$donation->id)}}" class="btn btn-warning">
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
            <div class="tab-pane" id="profile">
                <div class="table-responsive">
                    <table class="table table-inverse table-striped table-hover">
                        <thead>
                        <tr>
                            <th colspan="100%"><h3>{{trans_choice('string.documentation',2)}}</h3></th>
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>{{trans('string.created')}}</th>
                            <th>{{trans('string.actions')}}</th>
                        </tr>
                        </thead>
                        <tr>
                            {{Form::open(['action'=>array('ApplicantController@handleDocumentation',$applicant->id),'method'=>'POST','files'=>true])}}
                            <td>
                                <div class="form-group{{$errors->has('documentation') ? ' has-danger' : '' }}">
                                    {{Form::file('documentation',['class'=>'form-control form-control-sm'])}}
                                    @if($errors->has('documentation'))
                                        <div class="form-control-feedback">{{$errors->first('documentation')}}</div>
                                    @endif
                                </div>
                            </td>
                            <td>Now</td>
                            <td>
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-plus"></i> {{trans('string.upload')}}
                                </button>
                            </td>
                            {{Form::close()}}
                        </tr>

                        @foreach($applicant->documentation as $documentation)
                            <tr>
                                {{Form::open(['action'=>array('ApplicantController@handleDocumentationDelete',$documentation->id),'method'=>'POST'])}}
                                <td><a class="btn btn-sm btn-primary btn-block" href='{{ action('FileController@getDocumentation',$documentation->attachment) }}' target="_blank"><i class="fa fa-paperclip"></i> {{trans('string.view')}}</a></td>
                                <td>{{$documentation->created_at->diffForHumans()}}</td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-minus"></i> {{trans('string.delete')}}
                                    </button>
                                </td>
                                {{Form::close()}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('extra-js')
    <script>
        $('#nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        var hash = window.location.hash;

        $(document).ready(function () {
            $('#nav-tabs, .tab-content').removeClass('hidden');
            $('#nav-tabs a[href="' + hash + '"]').tab('show');
        });
    </script>
@endsection
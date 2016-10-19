@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                <div class="row">
                    <div class="col-md-3 card">
                        @include('applications.dashboard')
                    </div>

                    <div class="col-md-3 card">
                        @include('applicants.dashboard')
                    </div>

                    <div class="col-md-3 card">
                        @include('donors.dashboard')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

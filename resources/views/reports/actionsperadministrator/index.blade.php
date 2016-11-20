@section('title') {{trans('string.actions_per_administrator')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <p>This report shows amount of actions per administrator.</p>
            </div>
        </div>

        <div>
            {!! $chart->render() !!}
        </div>

        <br>
    </div>
@endsection

@section('extra-css')
    {!! Charts::assets(['highcharts']) !!}
@endsection

@section('extra-js')
    <script src="{{asset('public/vendor/consoletvs/charts/highcharts/js/themes/dark-unica.js')}}"></script>
@endsection

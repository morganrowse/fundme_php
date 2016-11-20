@section('title') {{trans('string.funding_type_performance')}} @endsection

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card card-outline-primary">
            <div class="card-block card-inverse card-primary">
                <h2 class="card-title">@yield('title')</h2>
            </div>
            <div class="card-block">
                <p>This report shows amount donated per funding type.</p>
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

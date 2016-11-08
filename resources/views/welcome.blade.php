@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-block card-inverse card-dark">
                        <h2 class="card-title display-1">{{trans('string.welcome')}}</h2>
                    </div>
                    <div class="card-block">
                        <h4>Changelog</h4>
                        <hr>
                        <p><strong>2016-11-7</strong></p>
                        <ul>
                            <li>add donation profiles</li>
                            <li>update report button groups</li>
                            <li>composer updates</li>
                            <li>ide helper</li>
                        </ul>
                        <p><strong>2016-11-2</strong></p>
                        <ul>
                            <li>add funding types</li>
                            <li>bootstrap update</li>
                            <li>update forms, cards and headers</li>
                            <li>added favicon</li>
                            <li>init card overlays</li>
                            <li>update login and register pages</li>
                        </ul>
                        <p><strong>2016-10-21</strong></p>
                        <ul>
                            <li>add applications</li>
                            <li>add applicants</li>
                            <li>add donors</li>
                            <li>add dashboards</li>
                        </ul>
                        <p><strong>2016-10-19</strong></p>
                        <ul>
                            <li>add auth</li>
                            <li>add whoops</li>
                            <li>add forms</li>
                        </ul>
                        <p><strong>2016-10-12</strong></p>
                        <ul>
                            <li>init</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-block">
                        <p class="lead">Successful stories and other news goes here</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
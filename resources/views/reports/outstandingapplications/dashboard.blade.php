<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans('string.outstanding_applications')}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\ReportController::getOutstandingApplicationsDashboardString()}}</em></p>
        <a href="{{route('outstandingapplications')}}" class="btn btn-primary">View</a>
    </div>
</div>
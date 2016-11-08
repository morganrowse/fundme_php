<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans('string.outstanding_applicants')}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\ReportController::getOutstandingApplicantsDashboardString()}}</em></p>
        <a href="{{route('outstandingapplicants')}}" class="btn btn-primary">View</a>
    </div>
</div>
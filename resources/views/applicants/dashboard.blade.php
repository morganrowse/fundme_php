<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.applicant',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\ApplicantController::getDashboardString()}}</em></p>
        <a href="{{route('applicants')}}" class="btn btn-primary">View</a>
    </div>
</div>
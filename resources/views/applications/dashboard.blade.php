<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.application',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\ApplicationController::getDashboardString()}}</em></p>
        <a href="{{route('applications')}}" class="btn btn-primary">View</a>
    </div>
</div>
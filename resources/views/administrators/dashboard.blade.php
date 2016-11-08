<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.administrator',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\AdministratorController::getDashboardString()}}</em></p>
        <a href="{{route('administrators')}}" class="btn btn-primary">View</a>
    </div>
</div>
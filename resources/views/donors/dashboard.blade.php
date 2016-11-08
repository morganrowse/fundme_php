<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.donor',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\DonorController::getDashboardString()}}</em></p>
        <a href="{{route('donors')}}" class="btn btn-primary">View</a>
    </div>
</div>
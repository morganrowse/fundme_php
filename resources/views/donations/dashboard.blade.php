<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.donation',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\DonationController::getDashboardString()}}</em></p>
        <a href="{{route('donations')}}" class="btn btn-primary">View</a>
    </div>
</div>
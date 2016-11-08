<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.funding_type',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\FundingTypeController::getDashboardString()}}</em></p>
        <a href="{{route('fundingtypes')}}" class="btn btn-primary">View</a>
    </div>
</div>
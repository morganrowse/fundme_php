<div class="card">
    <div class="card-block text-xs-center">

        <h1>
            <span class="fa-stack donation-colour">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-money fa-stack-1x fa-inverse"></i>
            </span>
        </h1>

        <h4 class="card-title">{{trans_choice('string.donation',2)}}</h4>
        <p class="card-text text-muted"><em>{{\App\Http\Controllers\DonationController::getDashboardString()}}</em></p>

    </div>
    <div class="card-footer text-xs-center">
        <a href="{{route('donations')}}" class="btn btn-primary">View</a>
        <a href="{{route('donations/create')}}" class="btn btn-success"><li class="fa fa-plus"></li></a>
    </div>
</div>
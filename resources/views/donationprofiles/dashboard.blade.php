<div class="card">
    <div class="card-block">
        <h4 class="card-title">{{trans_choice('string.donation_profile',2)}}</h4>
        <p class="card-text"><em>{{\App\Http\Controllers\DonationProfileController::getDashboardString()}}</em></p>
        <a href="{{route('donationprofiles')}}" class="btn btn-primary">View</a>
    </div>
</div>
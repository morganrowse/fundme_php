<?php

namespace App;

use App\Mail\NewApplication;
use App\Mail\NewDonation;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Mail;

class Fundme
{
    public static function getCurrency($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    public static function sendNewUserMail(User $user, $password = null)
    {
        Mail::to($user->email)->send(new NewUser($user,$password));
    }

    public static function sendNewApplicationMail(Application $application)
    {
        Mail::to($application->applicant->user->email)->send(new NewApplication($application));
    }

    public static function sendNewDonationMail(Donation $donation)
    {
        Mail::to($donation->application->applicant->user->email)->send(new NewDonation($donation));
    }
}
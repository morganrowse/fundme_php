<?php

namespace App;

use App\Mail\NewUserMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class Fundme
{
    public static function getCurrency($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    public static function sendNewUserMail(User $user, $password)
    {
        Mail::to($user->email)->send(new NewUserMail());
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $touches = ['application'];

    public function application(){
        return $this->belongsTo('App\Application');
    }

    public function donationProfile(){
        return $this->belongsTo('App\DonationProfile');
    }
}

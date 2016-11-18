<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationProfile extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function donor(){
        return $this->belongsTo('App\Donor');
    }

    public function donation(){
        return $this->hasMany('App\Donation');
    }

    public function fundingType(){
        return $this->belongsTo('App\FundingType');
    }

    public function getBalance() {
        return $this->maximum_amount-$this->donation->sum('amount');
    }
}

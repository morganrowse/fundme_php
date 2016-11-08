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

    public function fundingType(){
        return $this->belongsTo('App\FundingType');
    }
}

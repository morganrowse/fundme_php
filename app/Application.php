<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function fundingType(){
        return $this->belongsTo('App\FundingType');
    }

    public function applicant(){
        return $this->belongsTo('App\Applicant');
    }

    public function donations(){
        return $this->hasMany('App\Donation');
    }

    public function getFundedAmount(){
        return $this->donations()->sum('amount');
    }

    public function getFundedProgressBar() {
        $funded_amount = $this->getFundedAmount();

        if($this->amount>$funded_amount && $funded_amount>=0){
            return '<div class="text-xs-center">R'.number_format($funded_amount, 2, '.', ' ').' / R'.number_format($this->amount, 2, '.', ' ').'</div><progress class="progress progress-striped progress-success" value="'.Fundme::getCurrency($funded_amount).'" max="'.Fundme::getCurrency($this->amount).'"></progress>';
        } else {
            return '<div class="text-xs-center">R'.number_format($funded_amount, 2, '.', ' ').' / R'.number_format($this->amount, 2, '.', ' ').'</div><progress class="progress progress-striped progress-warning" value="100" max="100"></progress>';
        }
    }
}

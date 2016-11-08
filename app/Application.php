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
        if($this->amount>$this->getFundedAmount()){
            return '<div class="text-xs-center"><strong>R'.Fundme::getCurrency($this->getFundedAmount()).'</strong> out of <strong>R'.Fundme::getCurrency($this->amount).'</strong></div><progress class="progress progress-striped progress-success progress-animated" value="'.Fundme::getCurrency($this->getFundedAmount()).'" max="'.Fundme::getCurrency($this->amount).'"></progress>';
        } else {
            return '<div class="text-xs-center"><strong>100%</strong></div><progress class="progress progress-striped progress-success progress-animated" value="100" max="100"></progress>';

        }

    }

    public function getStatusLabel(){
        switch($this->application_status){
            case 0:
                return '<span class="tag tag-pill tag-success">'.trans('string.created').'</span>';
            break;
            case 1:
                return '<span class="tag tag-pill tag-primary">'.trans('string.unfunded').'</span>';
                break;
            case 2:
                return '<span class="tag tag-pill tag-warning">'.trans('string.partially_funded').'</span>';
                break;
            case 3:
                return '<span class="tag tag-pill tag-success">'.trans('string.fully_funded').'</span>';
                break;
            default:
                return '<span class="tag tag-pill tag-danger">'.trans('string.error').'</span>';
                break;

        }
    }
}

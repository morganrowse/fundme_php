<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'userable_id');
    }

    public function getStatusLabel(){
        switch($this->application_status){
            case 0:
                return '<label class="label label-success">'.trans('string.created').'</label>';
                break;
            case 1:
                return '<label class="label label-primary">'.trans('string.unfunded').'</label>';
                break;
            case 2:
                return '<label class="label label-warning">'.trans('string.partially_funded').'</label>';
                break;
            case 3:
                return '<label class="label label-success">'.trans('string.fully_funded').'</label>';
                break;
            default:
                return '<label class="label label-danger">'.trans('string.error').'</label>';
                break;

        }
    }
}

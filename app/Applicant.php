<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User', 'userable_id');
    }

    public function documentation()
    {
        return $this->hasMany('App\Documentation');
    }

    public function getStatusLabel(){
        if($this->documentation()->count()>0){
            return '<span class="tag tag-pill tag-success">'.trans('string.green').'</span>';
        } else {
            return '<span class="tag tag-pill tag-danger"">'.trans('string.red').'</span>';
        }
    }
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function documentation()
    {
        return $this->hasMany('App\Documentation');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }

    public function donations()
    {
        return $this->hasManyThrough('App\Donation', 'App\Application');
    }

    public function getStatus(){
        if($this->documentation()->where('created_at','>',Carbon::now()->subYear())->count()>0){
            return 'green';
        } else {
            return 'red';
        }
    }

    public function getStatusLabel(){
        if($this->getStatus()=='green'){
            return '<span class="tag tag-pill tag-success">'.trans('string.green').'</span>';
        } else {
            return '<span class="tag tag-pill tag-danger"">'.trans('string.red').'</span>';
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $touches = ['applicant'];

    public function applicant(){
        return $this->belongsTo('App\Applicant');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function administrator()
    {
        return $this->belongsTo('App\Administrator');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use LaravelTreats\Model\Traits\HasCompositePrimaryKey;

class Applicant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}

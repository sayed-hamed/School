<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{


    protected $guarded=[];


    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz','quiz_id');
    }
}

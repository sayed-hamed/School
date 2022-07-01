<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineMeeting extends Model
{
    protected $guarded=[];

    public function grade(){
        return $this->belongsTo('App\Models\Grad','grid_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','classroom_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


}

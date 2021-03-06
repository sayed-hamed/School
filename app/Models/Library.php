<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table="library";

    protected $guarded=[];

    public function grade(){
        return $this->belongsTo('App\Models\Grad','grad_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','class_id');
    }


    public function teacher(){
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
}

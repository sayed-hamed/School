<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded=[];



    public function student(){
        return $this->belongsTo('App\Models\Student','student_id');
    }

    public function p_grade(){
        return $this->belongsTo('App\Models\Grad','from_grad');
    }

    public function p_section(){
        return $this->belongsTo('App\Models\Section','from_section');
    }

    public function p_classroom(){
        return $this->belongsTo('App\Models\Classroom','from_classroom');
    }


    public function t_grade(){
        return $this->belongsTo('App\Models\Grad','to_grad');
    }

    public function t_section(){
        return $this->belongsTo('App\Models\Section','to_section');
    }

    public function t_classroom(){
        return $this->belongsTo('App\Models\Classroom','to_classroom');
    }

}

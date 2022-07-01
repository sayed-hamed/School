<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded=[];


    public function grade(){
        return $this->belongsTo('App\Models\Grad','grade_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','class_id');
    }

    public function teacher(){
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
}

<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    use HasTranslations;

    public $translatable = ['section_name'];

    protected $guarded=[];

    public function Grad(){
        return $this->belongsTo('App\Models\Grad','Grid_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','Class_id');
    }


    public function teachers(){
        return $this->belongsToMany('App\Models\Teacher','section_teacher');
    }
}

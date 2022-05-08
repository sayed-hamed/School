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
        return $this->belongsTo('App\Models\Grad');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','Class_id');
    }
}

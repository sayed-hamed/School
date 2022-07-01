<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;

    public $translatable = ['title'];
    protected $guarded=[];

    public function grade(){
        return $this->belongsTo('App\Models\Grad','grid_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Models\Classroom','class_id');
    }


}

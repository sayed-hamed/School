<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded=[];

    public function sections(){
        return $this->belongsToMany('App\Models\Section','section_teacher');
    }

    public function special(){
        return $this->belongsTo('App\Models\Spacialization','spec_id');
    }

    public function gend(){
        return $this->belongsTo('App\Models\Gender','gender_id');
    }
}

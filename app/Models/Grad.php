<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Grad extends Model
{
    use HasTranslations;

    public $translatable = ['name','notes'];
    protected $fillable=['name','notes'];

    public function classroom(){
        return $this->hasMany('App\Models\Classroom');
    }

    public function sections(){
        return $this->hasMany('App\Models\Section','Grid_id');
    }
}

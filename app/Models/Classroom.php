<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Classroom extends Model
{
    use HasTranslations;

    public $translatable = ['class_name'];

    protected $guarded=[];

    public function Grads(){
        return $this->belongsTo('App\Models\Grad','Grid_id');
    }
}

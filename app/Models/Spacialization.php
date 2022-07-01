<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Spacialization extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable=['name'];


    public function Teacher(){
        return $this->belongsToMany('App\Models\Teacher');
    }
}

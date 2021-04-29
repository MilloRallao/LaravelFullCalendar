<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $incrementing = false;
    
    public function cargaHoraria(){
        return $this->hasMany('App\CargaHoraria',"id");
    }
}

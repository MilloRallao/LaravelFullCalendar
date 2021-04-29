<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargaHoraria extends Model
{
    protected $table = 'carga_horaria';
    
    public function user(){
        return $this->belongsTo('App\User', 'profesor_id');
    }
    
    public function grupo(){
        return $this->belongsTo('App\Grupo',"grupo_id");
    }
}

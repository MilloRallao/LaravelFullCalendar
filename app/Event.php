<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_name','start_date','end_date', 'all_day', 'color'];
    
    public $timestamps = false;
    
    public function modulos(){
        return $this->belongsTo('App\Modulo', 'id');
    }
    
    public function franjas(){
        return $this->belongsTo('App\Franjas', 'id');
    }
    
    public function getAllDayAttribute($value){
        
        return $value ? true : false;
    }
}

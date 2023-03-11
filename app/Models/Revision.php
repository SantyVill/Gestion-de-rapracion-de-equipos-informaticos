<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisions';
    protected $fillable = ['nota','fecha','interna','tecnico_id','recepcion_id'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
    
    public function user(){
        return $this->belongsTo('App\Models\User','tecnico_id');
    }
    public function ocultar(){
        if ($this->interna && $this->tecnico_id!=auth()->user()->id && $this->recepcionista_id!=auth()->user()->id) {
            return false;
        } else {
            return true;
        }
    }

    public function recepcion(){
        return $this->belongsTo('App\Models\Recepcion');
    }
}

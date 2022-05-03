<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisions';
    protected $fillable = ['nota','fecha','tecnico_id','recepcion_id'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
    
    public function user(){
        return $this->belongsTo('App\Models\User','tecnico_id');
    }

    public function recepcion(){
        return $this->belongsTo('App\Models\Recepcion');
    }
}

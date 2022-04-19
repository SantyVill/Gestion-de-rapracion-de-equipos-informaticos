<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{

    protected $table = 'caracteristicas';
    protected $fillable = ['modelo','marca_id','tipo_id'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    // Relacion uno a muchos
    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo', 'tipo_id');
    }

    public function precios(){
        return $this->hasMany('App\Models\Precio','caracteristica_id');
    }
}

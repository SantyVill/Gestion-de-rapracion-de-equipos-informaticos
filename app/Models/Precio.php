<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'precios';
    protected $fillable = ['reparacion', 'precio', 'plazo', 'riesgo'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function caracteristica(){
        return $this->belongsTo('App\Models\Caracteristica');
    }
}

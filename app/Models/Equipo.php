<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $fillable = ['numero_serie','tipo','marca','fallas','modelo','accesorios','observacion'];//para permitir asignacion masiva
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['nombre','apellido','dni','telefono1','telefono2','direccion','mail','observacion'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
}

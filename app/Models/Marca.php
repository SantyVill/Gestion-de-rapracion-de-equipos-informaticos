<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $fillable = ['marca'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function caracteristicas(){
        return $this->hasMany('App\Models\Caracteristica','marca_id');
    }
}
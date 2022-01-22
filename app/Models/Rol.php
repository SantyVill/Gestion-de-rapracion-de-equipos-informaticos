<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['rol'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;



    
    // Relacion muchos a muchos
    public function users(){
        return $this->belongsToMany('App\Models\Usuario');
    }
}

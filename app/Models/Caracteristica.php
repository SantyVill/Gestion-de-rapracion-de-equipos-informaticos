<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{

    protected $table = 'caracteristicas';
    protected $fillable = ['modelo'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    // Relacion uno a muchos
public function marca(){
    return $this->belongsTo('App\Models\Caracteristica');
}

public function tipo(){
    return $this->belongsTo('App\Models\Caracteristica');
}
}

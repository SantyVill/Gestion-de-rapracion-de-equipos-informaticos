<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    protected $fillable = ['tipo','id'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function caracteristica(){
        return $this->hasMany('App\Models\Caracteristica','tipo_id');
    }
}

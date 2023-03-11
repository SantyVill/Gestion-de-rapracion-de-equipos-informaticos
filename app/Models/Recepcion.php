<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
    protected $table = 'recepciones';
    protected $fillable = [
        'recepcionista_id',
        'equipo_id',
        'estado_id',
        'cliente_id',
        'falla',
        'accesorio',
        'fecha_recepcion',
        'fecha_entrega',
        'informe_final',
        'observacion',
        'precio',
        'garantia'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
    public function estado(){
        return $this->belongsTo('App\Models\Estado');
    }
    public function revisiones(){
        return $this->hasMany(Revision::class);
    }
    public function terminada(){
        if (strcmp($this->estado->estado,'Equipo Entregado')==0) {
            return 'disabled';
        }
        return '';
    }
}

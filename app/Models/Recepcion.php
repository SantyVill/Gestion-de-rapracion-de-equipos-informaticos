<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public static function buscarPorId($id){
        $recepciones=Recepcion::where('id','like','%'.$id.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $recepciones;
    }

    public static function listarRecepciones($buscar){
        $recepciones=Recepcion::where('falla','like','%'.$buscar.'%')
            ->orwhere(
                'accesorio', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'id', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'fecha_recepcion', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo', 'numero_serie', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica.marca', 'marca', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica', 'modelo', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'estado', 'estado', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $recepciones;
    }
}

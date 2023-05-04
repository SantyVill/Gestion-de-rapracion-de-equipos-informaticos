<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $fillable = ['caracteristica_id','numero_serie','observacion'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
    
    public function caracteristica(){
        return $this->belongsTo('App\Models\Caracteristica');
    }
    
    public function recepciones(){
        return $this->hasMany('App\Models\Recepcion','equipo_id');
    }

    public static function listarEquipos($buscar){
        $equipos=Equipo::where('numero_serie','like','%'.$buscar.'%')
        ->orwhereRelation(
            'caracteristica', 'modelo', 'like' ,'%'.$buscar.'%'
        )
        ->orwhereRelation(
            'caracteristica.marca', 'marca', 'like' ,'%'.$buscar.'%'
        )
        ->orwhereRelation(
            'caracteristica.tipo', 'tipo', 'like' ,'%'.$buscar.'%'
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return $equipos;
    }

    public static function crearEquipo($request){
        try {
            request()->validate([
                'numero_serie'=>'required|max:'.config('tam_numSerie'),
                'observacion'=>'',
                'tipo'=>'required|max:'.config('tam_tipo'),
                'marca'=>'required|max:'.config('tam_marca'),
                'modelo'=>'required|max:'.config('tam_modelo'),
            ]);
    
            $marca=Marca::firstOrCreate(['marca'=> ucfirst($request['marca'])]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
            $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst($request['tipo'])]);
            $caracteristica=Caracteristica::firstOrCreate([
                'modelo'=>ucfirst($request['modelo']),
                'marca_id'=> $marca['id'],
                'tipo_id'=>$tipo['id']
            ]);
            
            $equipo=Equipo::create([
                'numero_serie'=>$request['numero_serie'],
                'observacion'=>ucfirst($request['observacion']),
                'caracteristica_id'=>$caracteristica['id']
            ]);
            return $equipo;
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
    }
}

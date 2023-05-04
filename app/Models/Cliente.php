<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['nombre','apellido','dni','telefono1','telefono2','direccion','mail','observacion'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;

    public function recepciones(){
        return $this->hasMany('App\Models\Recepcion','cliente_id');
    }
    public function setNombre(string $nombre){
        $this->nombre=$nombre;
        $this->save();
    }
    public function setApellido(string $apellido){
        $this->apellido=$apellido;
    }
    public function setDni(int $dni){
        $this->dni=$dni;
    }
    public function setTelefono1(int $Telefono){
        $this->telefono=$Telefono;
    }
    public function setTelefono2(int $telefono){
        $this->telefono=$telefono;
    }
    public static function  listarClientes($buscar){
        
        $clientes=Cliente::where('dni','like','%'.$buscar.'%')
        ->orwhere(
             DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            'telefono1','like','%'.$buscar.'%'
        )
        ->orwhere(
            'telefono2','like','%'.$buscar.'%'
        )
        ->orwhere(
            'direccion','like','%'.$buscar.'%'
        )
        ->orwhere(
            'mail','like','%'.$buscar.'%'
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return $clientes;
    }

    public static function crearCliente($request){
        $request['nombre']=ucfirst($request['nombre']);
        $request['apellido']=ucfirst($request['apellido']);
        $request['direccion']=ucfirst($request['direccion']);
        $request['observacion']=ucfirst($request['observacion']);
        $cliente=Cliente::create([
            'nombre'=>$request['nombre'],
            'apellido'=>$request['apellido'],
            'dni'=>$request['dni'],
            'telefono1'=>$request['telefono1'],
            'telefono2'=>$request['telefono2'],
            'direccion'=>$request['direccion'],
            'mail'=>$request['mail'],
            'observacion'=>$request['observacion']]);
        return $cliente;
        
    }

}

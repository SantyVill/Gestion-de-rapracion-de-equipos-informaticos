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

    public static function listarMarcas($buscar){
        $marcas=Marca::where('marca','like','%'.$buscar.'%')
        ->orderBy('marca', 'asc')
        ->paginate(10);
        return $marcas;
    }

    public static function crearMarca(string $marca,$modelo,$tipo){
        try {
            $marca=Marca::firstOrCreate(['marca'=> ucfirst($marca)]);
            if (isset($modelo) && $modelo!=[]) {
                $caracteristica= new Caracteristica([
                    'marca_id'=> $marca['id'],
                    'modelo'=> ucfirst($modelo)
                ]);
                if (isset($tipo)) {
                    $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst($tipo)]);
                    $caracteristica['tipo_id']=$tipo['id'];
                }
                Caracteristica::firstOrCreate([
                    'modelo'=>ucfirst($caracteristica['modelo']),
                    'marca_id'=> $caracteristica['marca_id'],
                    'tipo_id'=>$caracteristica['tipo_id']
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Se ha producido un error al intentar crear la marca.', 0, $e);
        }
    }
    public function agregarModelo(Caracteristica $nuevaCaracteristica){
        foreach ($this->caracteristicas as $caracteristica) {
            if ($caracteristica->modelo == $nuevaCaracteristica->modelo) {
                return;
            }
        }
        $nuevaCaracteristica->marca_id=$this->id;
    }
}
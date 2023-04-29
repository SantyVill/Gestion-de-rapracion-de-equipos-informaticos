<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Caracteristica;
use App\Models\Tipo;
use App\Models\Equipo;

class ModelosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Marca $marca)
    {
        return view('modelos.create',compact('marca'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Marca $marca)
    {
        try {
            request()->validate([
                'modelo'=>'required|max:'.config('tam_modelo'),
                'tipo'=>'required|max:'.config('tam_tipo'),
            ]);
            if (isset($request['modelo'])) {
                $caracteristica= new Caracteristica([
                    'marca_id'=> $marca['id'],
                    'modelo'=>ucfirst($request['modelo'])
                ]);
                if (isset($request['tipo'])) {
                    $tipo=Tipo::firstOrCreate(['tipo'=> request('tipo')]);
                    $caracteristica['tipo_id']=$tipo['id'];
                }
                Caracteristica::firstOrCreate([
                    'modelo'=>ucfirst($caracteristica['modelo']),
                    'marca_id'=> $caracteristica['marca_id'],
                    'tipo_id'=>$caracteristica['tipo_id']
                ]);
            }
            return redirect()->route('marcas.show',$marca);
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caracteristica = Caracteristica::find($id);
        return view('modelos.edit',compact('caracteristica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            request()->validate([
                'modelo'=>'required|max:'.config('tam_modelo'),
                'tipo'=>'required|max:'.config("tam_tipo"),
            ]);
            $tipo = Tipo::firstOrCreate(['tipo' => $request['tipo']]);
            $caracteristica = Caracteristica::find($id);
            $existe = Caracteristica::where('modelo', $request['modelo'])
            ->where('tipo_id', $tipo->id)
            ->where('marca_id', $request['marca_id'])
            ->exists();
            if ($existe) {
                $nuevaCaracteristica = Caracteristica::firstOrCreate([
                    'modelo' => $request['modelo'],
                    'tipo_id' => $tipo->id,
                    'marca_id' => $request['marca_id']
                ]);
                Equipo::where('caracteristica_id', '=', $caracteristica['id'])
                ->update(['caracteristica_id' => $nuevaCaracteristica['id']]);
                $caracteristica -> delete();
                return redirect()->route('marcas.show',Marca::find($caracteristica['marca_id']));
            }
            $caracteristica['modelo']=ucfirst($request['modelo']);
            if ($caracteristica->tipo->tipo!=$request['tipo']) {
                $tipo = Tipo::firstOrCreate(['tipo'=>$request['tipo']]);
                $caracteristica['tipo_id']=$tipo['id'];
            }
            $caracteristica->save();
            return redirect()->route('marcas.show',Marca::find($caracteristica['marca_id']));
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $caracteristica = Caracteristica::find($id);
        $marca = Marca::find($caracteristica['marca_id']);
        $caracteristica -> delete();
        return redirect()->route('marcas.show',$marca);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Caracteristica;
use App\Models\Tipo;

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
        $field=request()->validate([
            'modelo'=>'required'
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
        $caracteristica = Caracteristica::find($id);
        $caracteristica['modelo']=ucfirst($request['modelo']);
        if ($caracteristica->tipo->tipo!=$request['tipo']) {
            $tipo = Tipo::firstOrCreate(['tipo'=>$request['tipo']]);
            $caracteristica['tipo_id']=$tipo['id'];
        }
        $caracteristica->save();
        return redirect()->route('marcas.show',Marca::find($caracteristica['marca_id']));
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Precio;

use App\Models\Marca;

use App\Models\Caracteristica;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::get();
        return view('precios.index',compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $caracteristica = Caracteristica::find($id);
        return view('precios.create',compact('caracteristica'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $precio = Precio::create([
            'caracteristica_id'=>$id,
            'reparacion'=>ucfirst($request['reparacion']),
            'precio'=>$request['precio'],
            'plazo'=>$request['plazo'],
            'riesgo'=>ucfirst($request['riesgo']),
        ]);
        return redirect()->route('marcas.show',$precio->caracteristica->marca);
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
        $precio = Precio::find($id);
        return view('precios.edit',compact('precio'));
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
        $precio = Precio::find($id);
        $precio['reparacion']=$request['reparacion'];
        $precio['precio']=$request['precio'];
        $precio['plazo']=$request['plazo'];
        $precio['riesgo']=$request['riesgo'];
        $precio->save();
        return redirect()->route('marcas.show',$precio->caracteristica->marca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $precio=Precio::find($id);
        $precio->delete();
        return redirect()->route('marcas.show',$precio->caracteristica->marca);
    }
}

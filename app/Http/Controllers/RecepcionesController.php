<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;
use App\Models\Cliente;
use App\Models\Recepcion;
use App\Models\Estado;

class RecepcionesController extends Controller
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
    public function create(Equipo $equipo,Cliente $cliente/* ,Recepcion $recepcion */)
    {
        /* if (!isset($recepcion)) {
            $recepcion = New Recepcion();
        }
        $recepcion['equipo_id']=$equipo['id'];
        if (is_null($recepcion['equipo_id'])) {
            return redirect()->route('equipos.index');
        } */
        /* return $cliente; */
        return view('recepciones.create',compact('equipo'),compact('cliente')/* ,compact('recepcion') */);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Equipo $equipo,Cliente $cliente)
    {
        /* return $cliente['id']; */
        /* return auth()->user()->id; */
        $estado=Estado::firstOrCreate(['estado'=> 'A presupuestar']);
        /* return $estado['id']; */
        Recepcion::create([
            'equipo_id'=>$equipo['id'],
            'cliente_id'=>$cliente['id'],
            'estado_id'=>$estado['id'],
            'recepcionista_id'=>auth()->user()->id,//Hay que llenar este campo con el id del usuario logueado
            'falla'=>$request['falla'],
            'accesorio'=>$request['accesorio'],
            'observacion'=>$request['observacion'],
            'fecha_recepcion'=>now(),
            'falla'=>$request['falla']
        ]);

        return redirect()->route('equipos.index');//Agregar el index de recepciones cuando este completa
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

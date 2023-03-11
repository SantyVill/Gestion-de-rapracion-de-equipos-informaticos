<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use App\Models\Revision;
use Illuminate\Http\Request;

use App\Models\Estado;

class RevisionesController extends Controller
{
    protected $singular = 'revision';
    protected $resourceName = 'revision';
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
    public function create(Recepcion $recepcion)
    {
        return view('revisiones.create',compact('recepcion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recepcion $recepcion)
    {
        $fields = request()->validate([
            'nota'=>'required'
        ]);
        $revision = Revision::create([
            'tecnico_id'=>auth()->user()->id,
            'recepcion_id'=>$recepcion['id'],
            'nota'=>ucfirst($request['nota']),
            'fecha'=>date('Y-m-d H:i:s'),
            'interna' => ($request['interna'])?true:false,
        ]);
        $recepcion = $revision->recepcion;
        if ($request['estado']!='') {
            $nuevoEstado = Estado::firstOrCreate(['estado'=>$request['estado']]);
            $recepcion->estado_id= $nuevoEstado['id'];
        }
        $recepcion->save();
        return redirect() -> route('recepciones.show',$recepcion);
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
    public function edit(Revision $revision)
    {
        return view('revisiones.edit',compact('revision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revision $revision)
    {
        $revision->nota=$request['nota'];
        $revision->interna=($request['interna'])?true:false;
        $revision->save();
        return redirect() -> route('recepciones.show',$revision->recepcion_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revision $revision)
    {
        $recepcion_id=$revision->recepcion_id;
        $revision->delete();
        return redirect() -> route('recepciones.show',$revision->recepcion_id);
    }
}

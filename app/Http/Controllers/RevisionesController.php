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
        $posiblesEstados = Estado::transicionEstados($recepcion->estado->estado);
        return view('revisiones.create',compact('recepcion','posiblesEstados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recepcion $recepcion)
    {
        try {
            $nota='';
            if ($request['estado']!=null) {
                $nuevoEstado = Estado::firstOrCreate(['estado'=>$request['estado']]);
                if (strcmp($request['estado'],$recepcion->estado->estado)!=0) {
                    $nota = '###Nuevo estado: ' . $nuevoEstado->estado . '###. ';
                } else {
                    request()->validate([
                        'nota'=>'required'
                    ]);
                }
                $recepcion->estado_id= $nuevoEstado['id'];
                if ($nuevoEstado->estado=="Equipo Entregado") {
                    $recepcion->fecha_entrega = now();
                }
                $recepcion->save();
            } else {
                request()->validate([
                    'nota'=>'required'
                ]);
            }
            $revision = Revision::create([
                'tecnico_id'=>auth()->user()->id,
                'recepcion_id'=>$recepcion['id'],
                'nota'=>$nota.ucfirst($request['nota']),
                'fecha'=>date('Y-m-d H:i:s'),
                'interna' => ($request['interna'])?true:false,
            ]);
            return redirect() -> route('recepciones.show',$recepcion);
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
        try {
            request()->validate([
                'nota'=>'required'
            ]);
            $revision->nota=$request['nota'];
            $revision->interna=($request['interna'])?true:false;
            $revision->save();
            return redirect() -> route('recepciones.show',$revision->recepcion_id);
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
    public function destroy(Revision $revision)
    {
            $recepcion_id=$revision->recepcion_id;
            $revision->delete();
            return redirect() -> route('recepciones.show',$revision->recepcion_id);
    }
}

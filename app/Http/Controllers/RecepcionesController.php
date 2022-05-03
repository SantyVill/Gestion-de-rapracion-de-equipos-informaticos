<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use Symfony\Component\HttpFoundation\Response;

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
        $recepciones=Recepcion::get();
        return view('recepciones.index',compact('recepciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Equipo $equipo,Cliente $cliente /* ,Recepcion $recepcion */)
    {
        if (null!==(Cookie::get('equipo'))) {
            $equipo = Equipo::find(Cookie::get('equipo'));
        }
        if (null!==(Cookie::get('cliente'))) {
            $cliente = Cliente::find(Cookie::get('cliente'));
        }
        if (null!==(Cookie::get('recepcion'))) {
            $recepcion = json_decode(Cookie::get('recepcion'),true);
            return view('recepciones.create',compact('recepcion','cliente','equipo'));
        } else {
            return view('recepciones.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Equipo $equipo,Cliente $cliente)
    {
        if (isset($request['falla'])) {
            $estado=Estado::firstOrCreate(['estado'=> 'A presupuestar']);
            $recepcion = new Recepcion([
                'estado_id'=>$estado['id'],
                'recepcionista_id'=>auth()->user()->id,//Hay que llenar este campo con el id del usuario logueado
                'falla'=>$request['falla'],
                'accesorio'=>$request['accesorio'],
                'observacion'=>$request['observacion'],
                'fecha_recepcion'=>date('Y-m-d H:i:s'),
            ]);
            Cookie::queue('recepcion', $recepcion, 100);
        } else if(!(null!==(Cookie::get('recepcion')))) {
            return redirect()->route('recepciones.create');
        }

        if (isset($request['equipo_id'])) {
            Cookie::queue('equipo',$request['equipo_id'] , 100);
            return redirect()->route('recepciones.create');
        } else if(!(null!==(Cookie::get('equipo')))) {
            return redirect()->route('equipos.select_recepcion');
        }


        if (isset($request['cliente_id'])) {
            Cookie::queue('cliente',$request['cliente_id'] , 100);
            return redirect()->route('recepciones.create');
        } else if(!(null!==(Cookie::get('cliente')))) {
            return redirect()->route('clientes.select_recepcion');
        }

        $recepcion = json_decode(Cookie::get('recepcion'),true);
        $equipo_id=Cookie::get('equipo');
        $cliente_id=Cookie::get('cliente');
        Recepcion::create([
            'equipo_id'=>$equipo_id,
            'cliente_id'=>$cliente_id,
            'estado_id'=>$recepcion['estado_id'],
            'recepcionista_id'=>$recepcion['recepcionista_id'],//Hay que llenar este campo con el id del usuario logueado
            'falla'=>$recepcion['falla'],
            'accesorio'=>$recepcion['accesorio'],
            'observacion'=>$recepcion['observacion'],
            'fecha_recepcion'=>$recepcion['fecha_recepcion'],
        ]);
        Cookie::queue(Cookie::forget('recepcion'));
        Cookie::queue(Cookie::forget('equipo'));
        Cookie::queue(Cookie::forget('cliente'));
        return redirect()->route('recepciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recepcion=Recepcion::find($id);
  /*       foreach ($recepcion->revisiones as $revision) {
            return $revision;
        } */

        return view('recepciones.show',compact('recepcion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recepcion = Recepcion::find($id);
        return view('recepciones.edit',compact('recepcion'));
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
        $recepcion = Recepcion::find($id);
        $recepcion['falla'] = $request['falla'];
        $recepcion['accesorio'] = $request['accesorio'];
        $recepcion['observacion'] = $request['observacion'];
        $recepcion -> save();
        return redirect()->route('recepciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recepcion= Recepcion::find($id);
        $recepcion->delete();
        return redirect()->route('recepciones.index');
    }
/*     public function destroy(Recepcion $recepcion)
    {  //NO FUNCIONA
        $recepcion->delete();
        return redirect()->route('recepciones.index');
    } */
}

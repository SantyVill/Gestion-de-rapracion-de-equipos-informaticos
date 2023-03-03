<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\DB;

use App\Models\Equipo;
use App\Models\Cliente;
use App\Models\Recepcion;
use App\Models\Estado;
use Barryvdh\DomPDF\Facade\Pdf;

class RecepcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* return $request; */
        $buscar='';
        if ($request['NumOrden']=='1') {
            $buscarId = $request['buscar'];
            $recepciones=Recepcion::where('id','like','%'.$request['buscar'].'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            return view('recepciones.index',compact('recepciones','buscar'));
        } else {
            $buscar=$request['buscar'];
            $recepciones=Recepcion::where('falla','like','%'.$buscar.'%')
            ->orwhere(
                'accesorio', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'id', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'fecha_recepcion', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo', 'numero_serie', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica.marca', 'marca', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica', 'modelo', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'estado', 'estado', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }
        
        return view('recepciones.index',compact('recepciones','buscar'));
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
                'recepcionista_id'=>auth()->user()->id,
                'falla'=>ucfirst($request['falla']),
                'accesorio'=>ucfirst($request['accesorio']),
                'observacion'=>ucfirst($request['observacion']),
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
        Cookie::queue(Cookie::forget('recepcion'));
        Cookie::queue(Cookie::forget('equipo'));
        Cookie::queue(Cookie::forget('cliente'));
        $recepcion = Recepcion::find($id);
        return view('recepciones.edit',compact('recepcion'));
    }

    public function add_informe_final($id)
    {
        $recepcion = Recepcion::find($id);
        return view('recepciones.informe_final',compact('recepcion'));
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
        if (isset($request['equipo_id'])) {
            $recepcion->equipo_id=$request['equipo_id'];
            $recepcion->save();
            return redirect()->route('recepciones.show',$recepcion);
        }
        if (isset($request['cliente_id'])) {
            $recepcion->cliente_id=$request['cliente_id'];
            $recepcion->save();
            return redirect()->route('recepciones.show',$recepcion);
        }
        if ($request['informe_final']) {
            $recepcion['informe_final'] = ucfirst($request['informe_final']);
            $recepcion['precio']= $request['precio'];
            $recepcion['garantia'] = $request['garantia'];
            $recepcion->save();
            return redirect()->route('recepciones.show',$recepcion);
        }

        $estado=Estado::firstOrCreate(['estado'=> ucfirst($request['estado'])]);
        $recepcion['falla'] = ucfirst($request['falla']);
        $recepcion['accesorio'] = ucfirst($request['accesorio']);
        $recepcion['observacion'] = ucfirst($request['observacion']);
        $recepcion['estado_id'] = $estado->id;
        $recepcion -> save();
        return redirect()->route('recepciones.show',$recepcion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recepcion $recepcion)
    {
        /* $recepcion= Recepcion::find($id); */
        /* return $recepcion; */
        $recepcion->delete();
        return redirect()->route('recepciones.index');
    }
    public function generarPdfIngreso(Recepcion $recepcion)
    { 
        /* return view('recepciones.generarPdfIngreso',compact('recepcion')); */
        $pdf = Pdf::loadView('recepciones.generarPdfIngreso', compact('recepcion'));
        return $pdf->download($recepcion->cliente->apellido.$recepcion->cliente->nombre.$recepcion->fecha_recepcion.'.pdf');
    }
    public function generarPdfInforme(Recepcion $recepcion)
    { 
        /* return view('recepciones.generarPdfInforme',compact('recepcion')); */
        $pdf = Pdf::loadView('recepciones.generarPdfInforme', compact('recepcion'));
        return $pdf->download($recepcion->cliente->apellido.$recepcion->cliente->nombre.$recepcion->fecha_recepcion.'-Informe.pdf');
    }
}

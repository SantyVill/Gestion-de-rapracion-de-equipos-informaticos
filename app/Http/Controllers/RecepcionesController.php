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
use PhpParser\Node\Stmt\Return_;

class RecepcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar='';
        if ($request['NumOrden']=='1') {
            $buscarId = $request['buscar'];
            $recepciones=Recepcion::buscarPorId($buscarId);
            return view('recepciones.index',compact('recepciones','buscar'));
        } else {
            $buscar=$request['buscar'];
            $recepciones=Recepcion::listarRecepciones($buscar);
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
        try {
            /* return $request['equipo_id']; */
            if (isset($request['falla'])) {
                request()->validate([
                    'falla'=>'required|max:'.config("tam_falla"),
                    'observacion'=>'',
                    'accesorio'=>'max:'.config("tam_accesorio"),
                ]);
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
            
            if (isset($request['numero_serie'])) {
                $equipo=Equipo::crearEquipo($request);
                Cookie::queue('equipo',$equipo['id'] , 100);
                return redirect()->route('recepciones.create');
            }
            if (isset($request['equipo_id'])) {
                Cookie::queue('equipo',$request['equipo_id'] , 100);
                return redirect()->route('recepciones.create');
            } else if(!(null!==(Cookie::get('equipo')))) {
                return redirect()->route('equipos.select_recepcion');
            }
    
    
            if (isset($request['nombre'])) {
                try {
                    request()->validate([
                        'nombre'=>'required|max:'.config('tam_nombre'),
                        'apellido'=>'required|max:'.config('tam_apellido'),
                        'dni'=>''/* .config('tam_dni') */,
                        'telefono1'=>'required|max:'.config('tam_telefono'),
                        'telefono2'=>'max:'.config('tam_telefono'),
                        'direccion'=>'max:'.config('tam_direccion'),
                        'mail'=>'required|max:'.config('tam_mail'),
                        'observacion'=>''
                    ]);
                    $cliente=Cliente::crearCliente($request);
                    Cookie::queue('cliente',$cliente['id'] , 100);
                    return redirect()->route('recepciones.create');
                } catch (\Illuminate\Database\QueryException $e) {
                    $mensaje = 'Se produjo un error en la carga de datos';
                    return redirect()->back()->with('message', $mensaje);
                }
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
        try {
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
    
            $estado=Estado::firstOrCreate(['estado'=> ucfirst($request['estado'])]);
            /* if ($estado->estado!="Equipo Entregado") {
                $recepcion->fecha_entrega = null;
            } */
            if (isset($request['falla']) || isset($request['accesorio'])) {
                request()->validate([
                    'falla'=>'required|max:'.config("tam_falla"),
                    'accesorio'=>'max:'.config("tam_accesorio"),
                ]);
                $recepcion['falla'] = ucfirst($request['falla']);
                $recepcion['observacion'] = ucfirst($request['observacion']);
                $recepcion['accesorio'] = ucfirst($request['accesorio']);
            }
            $recepcion['estado_id'] = $estado->id;
            $recepcion -> save();
            return redirect()->route('recepciones.show',$recepcion);
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
    }
    public function agregarInforme(Request $request, $id)
    {
        try {
            request()->validate([
                'informe_final'=>'required',
                'precio'=>'required|max:'.config("tam_precio"),
                'garantia'=>'required',
            ]);
            $recepcion = Recepcion::find($id);
            if ($request['informe_final']) {
                $recepcion['informe_final'] = ucfirst($request['informe_final']);
                $recepcion['precio']= $request['precio'];
                $recepcion['garantia'] = $request['garantia'];
                $recepcion->save();
                return redirect()->route('recepciones.show',$recepcion);
            }

            return redirect()->route('recepciones.show',$recepcion);
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
    public function destroy(Recepcion $recepcion)
    {
        $recepcion->delete();
        return redirect()->route('recepciones.index');
    }
    public function generarPdfIngreso(Recepcion $recepcion)
    { 
        /* return view('recepciones.generarPdfIngreso',compact('recepcion')); */
        $pdf = Pdf::loadView('recepciones.generarPdfIngreso', compact('recepcion'));
        return $pdf->stream($recepcion->cliente->apellido.$recepcion->cliente->nombre.$recepcion->fecha_recepcion.'.pdf');
    }
    public function generarPdfInforme(Recepcion $recepcion)
    { 
        /* return view('recepciones.generarPdfInforme',compact('recepcion')); */
        $pdf = Pdf::loadView('recepciones.generarPdfInforme', compact('recepcion'));
        return $pdf->stream($recepcion->cliente->apellido.$recepcion->cliente->nombre.$recepcion->fecha_recepcion.'-Informe.pdf');
    }
}

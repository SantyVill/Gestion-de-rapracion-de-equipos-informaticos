<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcion;
use Illuminate\Support\Facades\Config;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $buscar = $request['buscar'];
        $clientes = Cliente::listarClientes($buscar);
        
         return view('clientes.index',compact('clientes','buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $field=request()->validate([
                'nombre'=>'required|max:'.config('tam_nombre'),
                'apellido'=>'required|max:'.config('tam_apellido'),
                'dni'=>''/* .config('tam_dni') */,
                'telefono1'=>'required|max:'.config('tam_telefono'),
                'telefono2'=>'max:'.config('tam_telefono'),
                'direccion'=>'max:'.config('tam_direccion'),
                'mail'=>'required|max:'.config('tam_mail'),
                'observacion'=>''
            ]);/* validaciones:  https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 */
            $field['nombre']=ucfirst($field['nombre']);
            $field['apellido']=ucfirst($field['apellido']);
            $field['direccion']=ucfirst($field['direccion']);
            $field['observacion']=ucfirst($field['observacion']);
            Cliente::create($field);
            return redirect()->route('clientes.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se produjo un error en la carga de datos';
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
        $cliente = cliente::find($id);
        return view('clientes.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cliente $cliente)
    {
        try {
        request()->validate([
            'nombre'=>'required|max:'.config('tam_nombre'),
            'apellido'=>'required|max:'.config('tam_apellido'),
            'dni'=>'max:'.config('tam_dni'),
            'telefono1'=>'required|max:'.config('tam_telefono'),
            'telefono2'=>'max:'.config('tam_telefono'),
            'direccion'=>'max:'.config('tam_direccion'),
            'mail'=>'required|max:'.config('tam_mail'),
            'observacion'=>''
        ]);

        $cliente->update([
            'nombre'=>ucfirst(request('nombre')),
            'apellido'=>ucfirst(request('apellido')),
            'dni'=>request('dni'),
            'telefono1'=>request('telefono1'),
            'telefono2'=>request('telefono2'),
            'direccion'=>ucfirst(request('direccion')),
            'mail'=>request('mail'),
            'observacion'=>ucfirst(request('observacion'))
        ]);
        return redirect()->route('clientes.show',$cliente);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al cargar los datos.'/*  . $e->getMessage() */;
            return redirect()->back()->with('message', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        
        try {
            $cliente->delete();
            return redirect()->route('clientes.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error de integridad en la base de datos: Primero debe eliminar las recepciones en las que se registro este cliente.'/*  . $e->getMessage() */;
            return redirect()->back()->with('message', $mensaje);
        }
    }

    public function select_cliente_recepcion(Request $request)
    {
        $buscar = $request['buscar'];
        $clientes=Cliente::listarClientes($buscar);
        return view('clientes.select_cliente_recepcion',compact('clientes','buscar'));
    }

    public function createRecepcion()
    {
        return view('clientes.createParaRecepcion');
    }

    public function update_cliente_recepcion(Request $request,Recepcion $recepcion)
    {
        $buscar = $request['buscar'];
        $clientes=Cliente::listarClientes($buscar);
        
        return view('clientes.update_cliente_recepcion',compact('clientes','buscar','recepcion'));
        
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcion;
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
        $clientes=Cliente::where('dni','like','%'.$buscar.'%')
        /* ->orwhere(
            'apellido','like','%'.$buscar.'%'
        ) */
        /* ->orwhere(
            'nombre','like','%'.$buscar.'%'
        ) */
        ->orwhere(
             DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            'telefono1','like','%'.$buscar.'%'
        )
        ->orwhere(
            'telefono2','like','%'.$buscar.'%'
        )
        ->orwhere(
            'direccion','like','%'.$buscar.'%'
        )
        ->orwhere(
            'mail','like','%'.$buscar.'%'
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
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
        $field=request()->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'',
            'telefono1'=>'required',
            'telefono2'=>'',
            'direccion'=>'',
            'mail'=>'required',
            'observacion'=>''
        ]);/* validaciones:  https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 */
        Cliente::create($field);
        return redirect()->route('clientes.index');
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
        $fields = request()->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'dni'=>'',
            'telefono1'=>'required',
            'telefono2'=>'',
            'direccion'=>'',
            'mail'=>'required',
            'observacion'=>''
        ]);

        $cliente->update([
            'nombre'=>request('nombre'),
            'apellido'=>request('apellido'),
            'dni'=>request('dni'),
            'telefono1'=>request('telefono1'),
            'telefono2'=>request('telefono2'),
            'direccion'=>request('direccion'),
            'mail'=>request('mail'),
            'observacion'=>request('observacion')
        ]);
        return redirect()->route('clientes.show',$cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index');
    }

    public function select_cliente_recepcion()
    {
        $clientes=Cliente::get();
        return view('clientes.select_cliente_recepcion',compact('clientes'));
    }

    public function update_cliente_recepcion(Request $request,Recepcion $recepcion)
    {
        $buscar = $request['buscar'];
        $clientes=Cliente::where('dni','like','%'.$buscar.'%')
        ->orwhere(
             DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
        )
        ->orwhere(
            'telefono1','like','%'.$buscar.'%'
        )
        ->orwhere(
            'telefono2','like','%'.$buscar.'%'
        )
        ->orwhere(
            'direccion','like','%'.$buscar.'%'
        )
        ->orwhere(
            'mail','like','%'.$buscar.'%'
        )
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('clientes.update_cliente_recepcion',compact('clientes','buscar','recepcion'));
        
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {   
        if (isset($request['buscar']) && $request['buscar']!='') {
            $clientes=Cliente::where('nombre','like','%'.$request['buscar'].'%')
            ->orwhere(
                'apellido','like','%'.$request['buscar'].'%'
            )
            ->orwhere(
                'dni','like','%'.$request['buscar'].'%'
            )
            ->orwhere(
                'telefono1','like','%'.$request['buscar'].'%'
            )
            ->orwhere(
                'telefono2','like','%'.$request['buscar'].'%'
            )
            ->orwhere(
                'direccion','like','%'.$request['buscar'].'%'
            )
            ->orwhere(
                'mail','like','%'.$request['buscar'].'%'
            )
            ->get();
        } else {
            $clientes=Cliente::get();
        }
        
        /*return $clientes;*/
         return view('clientes.index',compact('clientes'));

         /* return auth()->user()->roles;
        if (in_array('recepcionista',auth()->user()->roles)) { */
        /* if(auth()->check()){
            $clientes=Cliente::get();
             return view('clientes.index',compact('clientes'),compact('equipo'));
        } else {
            return back()->withErrors([
                'message' => 'Para acceder a esta ruta debes iniciar sesion',
            ]);
        } */
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
        return $cliente;
        $cliente->delete();
        return redirect()->route('clientes.index');
    }

    public function select_cliente_recepcion()
    {
        $clientes=Cliente::get();
        return view('clientes.select_cliente_recepcion',compact('clientes'));
    }
}

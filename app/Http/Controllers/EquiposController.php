<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;

use App\Models\Marca;

use App\Models\Caracteristica;

use App\Models\Tipo;

use Illuminate\Support\Facades\DB;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $equipos = Equipo::get(); */
        /* $equipos = [
             ['marca' => 'marca1'],
            ['marca' => 'marca2'],
            ['marca' => 'marca3'],
            ['marca' => 'marca4'] 
        ]; */
        $equipos=Equipo::get();
        return view('equipos.index',compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipos.create');
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
            'numero_serie'=>'required',
            'observacion'=>'',
            'tipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'fallas'=>'',
            'accesorios'=>'',
        ]);/* validaciones:  https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 */

        Marca::firstOrCreate(['marca'=> request('marca')]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
        $id_marca=Marca::get()->where('marca','=',request('marca'))->pluck('id')->first();
        Tipo::firstOrCreate(['tipo'=> request('tipo')]);
        $id_tipo=Tipo::get()->where('tipo','=',request('tipo'))->pluck('id')->first();

        $caracteristica=Caracteristica::firstOrCreate([
            'modelo'=>request('modelo'),
            'marca_id'=> $id_marca,
            'tipo_id'=>$id_tipo
        ]);

        $equipo=Equipo::create(['numero_serie'=>request('numero_serie'),'observacion'=>request('observacion')]);
        $equipo->caracteristica()->associate($caracteristica);
        $equipo->save();
        
        return redirect()->route('equipos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo = Equipo::find($id);
        return view('equipos.show',compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        return view('equipos.edit',compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        $fields = request()->validate([
            'numero_serie'=>'required',
            'tipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'fallas'=>'',
            'accesorios'=>'',
            'observacion'=>''
        ]);

        /* $equipo->update([
            'numero_serie'=>request('numero_serie'),
            'tipo'=>request('tipo'),
            'marca'=>request('marca'),
            'modelo'=>request('modelo'),
            'fallas'=>request('fallas'),
            'accesorios'=>request('accesorios'),
            'observacion'=>request('observacion')
        ]); */

        Marca::firstOrCreate(['marca'=> request('marca')]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
        $id_marca=Marca::get()->where('marca','=',request('marca'))->pluck('id')->first();
        Tipo::firstOrCreate(['tipo'=> request('tipo')]);
        $id_tipo=Tipo::get()->where('tipo','=',request('tipo'))->pluck('id')->first();

        $caracteristica=Caracteristica::firstOrCreate([
            'modelo'=>request('modelo'),
            'marca_id'=> $id_marca,
            'tipo_id'=>$id_tipo
        ]);

        $equipo->observacion=request('observacion');
        $equipo->numero_serie=request('numero_serie');
        $equipo->caracteristica()->associate($caracteristica);
        $equipo->save();
        return redirect()->route('equipos.show',$equipo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index');
    }
}

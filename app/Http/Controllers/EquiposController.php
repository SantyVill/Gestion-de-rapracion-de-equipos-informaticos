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
    public function index(Request $request)
    {
        if (isset($request['buscar']) && $request['buscar']!='') {
            $equipos=Equipo::where('numero_serie','like','%'.$request['buscar'].'%')
            ->orwhereRelation(
                'caracteristica', 'modelo', 'like' ,'%'.$request['buscar'].'%'
            )
            ->orwhereRelation(
                'caracteristica.marca', 'marca', 'like' ,'%'.$request['buscar'].'%'
            )
            ->orwhereRelation(
                'caracteristica.tipo', 'tipo', 'like' ,'%'.$request['buscar'].'%'
            )
            ->get();
            return view('equipos.index',compact('equipos'));
        } else {
            $equipos=Equipo::get();
        }
        
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

        $marca=Marca::firstOrCreate(['marca'=> request('marca')]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
        //$id_marca=Marca::get()->where('marca','=',request('marca'))->pluck('id')->first();
        $tipo=Tipo::firstOrCreate(['tipo'=> request('tipo')]);
        //$id_tipo=Tipo::get()->where('tipo','=',request('tipo'))->pluck('id')->first();

        $caracteristica=Caracteristica::firstOrCreate([
            'modelo'=>request('modelo'),
            'marca_id'=> $marca['id'],
            'tipo_id'=>$tipo['id']
        ]);
        //otra forma:
        //$equipo=Equipo::create(['numero_serie'=>request('numero_serie'),'observacion'=>request('observacion')]);
        //$equipo->caracteristica()->associate($caracteristica);
        //$equipo->save();
        
        $equipo=Equipo::create([
            'numero_serie'=>request('numero_serie'),
            'observacion'=>request('observacion'),
            'caracteristica_id'=>$caracteristica['id']
        ]);
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



        $marca=Marca::firstOrCreate(['marca'=> request('marca')]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
        #$id_marca=Marca::get()->where('marca','=',request('marca'))->pluck('id')->first();
        $tipo=Tipo::firstOrCreate(['tipo'=> request('tipo')]);
        #$id_tipo=Tipo::get()->where('tipo','=',request('tipo'))->pluck('id')->first();

        $caracteristica=Caracteristica::firstOrCreate([
            'modelo'=>request('modelo'),
            'marca_id'=> $marca['id'],
            'tipo_id'=>$tipo['id']
        ]);
        //1 forma:
        /* $equipo->update([
            'numero_serie'=>request('numero_serie'),
            'observacion'=>request('observacion'),
            'caracteristica_id'=>$caracteristica['id']
        ]); */
        
        //2 forma
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

    public function select_equipo_recepcion()
    {
        $equipos=Equipo::get();
        return view('equipos.select_equipo_recepcion',compact('equipos'));
    }

    public function update_equipo_recepcion()
    {
        $equipos=Equipo::get();
        return view('equipos.update_equipo_recepcion',compact('equipos'));
    }
}

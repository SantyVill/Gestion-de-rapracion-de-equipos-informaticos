<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;

use App\Models\Marca;

use App\Models\Caracteristica;

use App\Models\Tipo;

use DB;

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

        $marca=Marca::get()->where('marca','=','marca2');
        return empty($marca);
        if (isset($marca->marca)) {
            return ($marca);
        } else {
            return '0';
        }
        if (isset($request->marca)) {
            $marca = Marca::create(['marca'=> request('marca')]);
            /* if (null==($marca=Marca::get()->where('marca','=',$request->marca))) {
                $marca = Marca::create(['marca'=> request('marca')]);
            } */
        }
        return $marca;
        if (isset($request->tipo)) {
            $tipo = Tipo::create(['tipo'=> request('tipo')]);
            /* if (null==($tipo=Tipo::get()->where('tipo','=',$request->tipo))) {
                $tipo = Tipo::create(['tipo'=> request('tipo')]);
            } */
        }
        
        if (isset($request->modelo)) {
            $caracteristica = Caracteristica::create(['modelo'=> request('modelo'),
                                                    'marca_id'=>$marca,
                                                    'tipo_id'=>$tipo]);
            /* $caracteristica->tipo()->attach($tipo);
            $caracteristica->marca()->attach($marca); */
        }
            $equipo = Equipo::create($field);
        
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

        $equipo->update([
            'numero_serie'=>request('numero_serie'),
            'tipo'=>request('tipo'),
            'marca'=>request('marca'),
            'modelo'=>request('modelo'),
            'fallas'=>request('fallas'),
            'accesorios'=>request('accesorios'),
            'observacion'=>request('observacion')
        ]);
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

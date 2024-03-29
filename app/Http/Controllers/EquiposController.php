<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;

use App\Models\Marca;

use App\Models\Caracteristica;

use App\Models\Tipo;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\DB;

use App\Models\Recepcion;
use PhpParser\Node\Stmt\TryCatch;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar=$request['buscar'];
        $equipos=Equipo::listarEquipos($buscar);
        return view('equipos.index',compact('equipos','buscar'));
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
        try {
            request()->validate([
                'numero_serie'=>'required|max:'.config('tam_numSerie'),// "App/providers/AppServiceProvider" para editar vaiables globales
                'observacion'=>'',
                'tipo'=>'required|max:'.config('tam_tipo'),
                'marca'=>'required|max:'.config('tam_marca'),
                'modelo'=>'required|max:'.config('tam_modelo'),
            ]);/* validaciones:  https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 */
    
            $marca=Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
            $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst(request('tipo'))]);
            $caracteristica=Caracteristica::firstOrCreate([
                'modelo'=>ucfirst(request('modelo')),
                'marca_id'=> $marca['id'],
                'tipo_id'=>$tipo['id']
            ]);
            
            $equipo=Equipo::create([
                'numero_serie'=>request('numero_serie'),
                'observacion'=>ucfirst(request('observacion')),
                'caracteristica_id'=>$caracteristica['id']
            ]);
            return redirect()->route('equipos.index');
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
        try {
            request()->validate([
                'numero_serie'=>['required','max:'.config('tam_numSerie')],
                'tipo'=>'required|max:'.config('tam_tipo'),
                'marca'=>'required|max:'.config('tam_marca'),
                'modelo'=>'required|max:'.config('tam_modelo'),
                'observacion'=>''
            ]);
    
    
    
            $marca=Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
            $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst(request('tipo'))]);
    
            $caracteristica=Caracteristica::firstOrCreate([
                'modelo'=>ucfirst(request('modelo')),
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
            $equipo->observacion=ucfirst(request('observacion'));
            $equipo->numero_serie=request('numero_serie');
            $equipo->caracteristica()->associate($caracteristica);
            $equipo->save();
            return redirect()->route('equipos.show',$equipo);
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
    public function destroy(Equipo $equipo)
    {
        try {
            $equipo->delete();
            return redirect()->route('equipos.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error de integridad en la base de datos: Primero debe eliminar las recepciones en las que se registro este quipo.'/*  . $e->getMessage() */;
            return redirect()->back()->with('message', $mensaje);
        }
    }

    public function select_equipo_recepcion(Request $request)
    {
        $buscar=$request['buscar'];
        $equipos=Equipo::listarEquipos($buscar);
        return view('equipos.select_equipo_recepcion',compact('equipos','buscar'));
    }

    public function createRecepcion()
    {
        return view('equipos.createParaRecepcion');
    }

    public function storeRecepcion(Request $request)
    {
        try {
            request()->validate([
                'numero_serie'=>'required|max:'.config('tam_numSerie'),// "App/providers/AppServiceProvider" para editar vaiables globales
                'observacion'=>'',
                'tipo'=>'required|max:'.config('tam_tipo'),
                'marca'=>'required|max:'.config('tam_marca'),
                'modelo'=>'required|max:'.config('tam_modelo'),
            ]);/* validaciones:  https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 */
    
            $marca=Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);//firstOrCreate busca si existe el registro y lo devuelve, sino lo crea
            $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst(request('tipo'))]);
            $caracteristica=Caracteristica::firstOrCreate([
                'modelo'=>ucfirst(request('modelo')),
                'marca_id'=> $marca['id'],
                'tipo_id'=>$tipo['id']
            ]);
            
            $equipo=Equipo::create([
                'numero_serie'=>request('numero_serie'),
                'observacion'=>ucfirst(request('observacion')),
                'caracteristica_id'=>$caracteristica['id']
            ]);
            
            Cookie::queue('equipo',$request['equipo_id'] , 100);
            return redirect()->route('recepciones.store');
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
    }

    public function update_equipo_recepcion(Request $request,Recepcion $recepcion)
    {
        $buscar=$request['buscar'];
        $equipos=Equipo::listarEquipos($buscar);
        return view('equipos.update_equipo_recepcion',compact('equipos','buscar','recepcion'));
    }
}

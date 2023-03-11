<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Marca;
use App\Models\Tipo;
use App\Models\Caracteristica;
class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $marcas = Marca::paginate(10); */
        $buscar=$request['buscar'];
        $marcas=Marca::where('marca','like','%'.$buscar.'%')
        
        ->orderBy('marca', 'asc')
        ->paginate(10);

        return view('marcas.index',compact('marcas','buscar'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
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
            'marca'=>'required'
        ]);
        $marca=Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);
        if (isset($request['modelo']) && $request['modelo']!=[]) {
            $caracteristica= new Caracteristica([
                'marca_id'=> $marca['id'],
                'modelo'=> ucfirst($request['modelo'])
            ]);
            if (isset($request['tipo'])) {
                $tipo=Tipo::firstOrCreate(['tipo'=> ucfirst(request('tipo'))]);
                $caracteristica['tipo_id']=$tipo['id'];
            }
            Caracteristica::firstOrCreate([
                'modelo'=>ucfirst($caracteristica['modelo']),
                'marca_id'=> $caracteristica['marca_id'],
                'tipo_id'=>$caracteristica['tipo_id']
            ]);
        }
        return redirect()->route('marcas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = Marca::find($id);
        return view('marcas.show',compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca=Marca::find($id);
        return view('marcas.edit',compact('marca'));
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
        $nuevaMarca = Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);
        $marca = Marca::find($id);
        Caracteristica::where('marca_id', '=', $marca['id'])
        ->update(['marca_id' => $nuevaMarca['id']]);
        $marca -> delete();
        return redirect()->route('marcas.index',$nuevaMarca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            $marca = Marca::find($id);
            $marca -> delete();
            return redirect()->route('marcas.index');
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error de integridad en la base de datos: Primero debe eliminar las recepciones en las que se registro este quipo.'/*  . $e->getMessage() */;
            return redirect()->back()->with('message', $mensaje)->with('error', true);
        }
    }
}

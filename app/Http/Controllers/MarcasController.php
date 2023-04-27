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
        $marcas=Marca::listarMarcas($buscar);

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
        request()->validate([
            'marca'=>'required'
        ]);
        Marca::crearMarca($request['marca'],$request['modelo'],$request['tipo']);
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
        $modificarMarca = Marca::find($id);
        if ($marca = Marca::where('marca',$request['marca'])->first()) {
            foreach ($modificarMarca->caracteristicas as $caracteristica) {
                $marca->agregarModelo($caracteristica);
            }
            $modificarMarca->delete();
        } else {
            $modificarMarca->marca=$request['marca'];
            $modificarMarca->save();
        }
        return redirect()->route('marcas.index');
        $nuevaMarca = Marca::firstOrCreate(['marca'=> ucfirst(request('marca'))]);
        return $nuevaMarca;
        if ($nuevaMarca != $marca) {
            // Busca todos los caracteristicas que pertenecen a la marca que se está actualizando
            $caracteristicas = Caracteristica::where('marca_id', $marca->id)->get();

            // Actualiza los caracteristicas para que pertenezcan a la nueva marca
            foreach ($caracteristicas as $caracteristica) {
                $caracteristica->marca_id = $nuevaMarca->id;
                $caracteristica->save();
            }

            // Busca y elimina los caracteristicas duplicados en la marca "samsung"
            $caracteristicasRepetidos = Caracteristica::where('marca_id', $nuevaMarca->id)
                                    ->groupBy('modelo')
                                    ->havingRaw('COUNT(*) > 1')
                                    ->get();
            foreach ($caracteristicasRepetidos as $caracteristica) {
                $caracteristicasAEliminar = Caracteristica::where('marca_id', $nuevaMarca->id)
                                        ->where('modelo', $caracteristica->modelo)
                                        ->where('id', '<>', $caracteristica->id)
                                        ->get();
                foreach ($caracteristicasAEliminar as $caracteristicaAEliminar) {
                    $caracteristicaAEliminar->delete();
                }
            }

            // Elimina la marca original
            $marca->delete();
        } else {
            $marca->marca = $request['marca'];
            $marca->save();
        }

        return redirect()->route('marcas.index', $nuevaMarca);
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

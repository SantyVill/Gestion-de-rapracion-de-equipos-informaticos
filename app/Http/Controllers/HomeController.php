<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcion;
use App\Models\Equipo;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recepciones = Recepcion::all();
    $equipoMasRegistrado = Equipo::withCount('recepciones')
    ->orderBy('recepciones_count', 'desc')
    ->first();

    $marcaMasRepetida = Recepcion::join('equipos', 'recepciones.equipo_id', '=', 'equipos.id')
    ->join('caracteristicas', 'equipos.caracteristica_id', '=', 'caracteristicas.id')
    ->join('marcas', 'caracteristicas.marca_id', '=', 'marcas.id')
    ->groupBy('marcas.marca')
    ->select('marcas.marca', DB::raw('COUNT(*) as cantidad'))
    ->orderByDesc('cantidad')
    ->first();

    return view('home')->with('recepciones', $recepciones)->with('equipoMasRegistrado',$equipoMasRegistrado)->with('marcaMasRepetida',$marcaMasRepetida);
    }
}

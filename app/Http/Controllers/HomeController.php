<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcion;
use App\Models\Equipo;
use Illuminate\Support\Carbon;
use App\Models\Estado;


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
    $recepcionesPendientes = DB::table('recepciones')
                ->join('estados', 'recepciones.estado_id', '=', 'estados.id')
                ->where('estados.estado', '!=', 'Equipo Entregado')
                ->select('recepciones.*')
                ->get();
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

    $estadoEntregado = Estado::where('estado', 'Equipo Entregado')->first()->id;
    $montoTotal = Recepcion::where('estado_id', $estadoEntregado)->sum('precio');

    $now = Carbon::now();
    $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
    $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

    $recaudadoMesPasado = Recepcion::where('estado_id', $estadoEntregado)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('precio');

    return view('home', compact('recepciones', 'equipoMasRegistrado', 'marcaMasRepetida', 'recepcionesPendientes', 'montoTotal', 'recaudadoMesPasado'));

    }
}

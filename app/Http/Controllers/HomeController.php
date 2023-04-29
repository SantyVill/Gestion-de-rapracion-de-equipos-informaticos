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
    $recepcionesPendientes = Recepcion::recepcionesPendientes();

    $recepciones = Recepcion::all();
    $equipoMasRegistrado = Equipo::withCount('recepciones')
    ->orderBy('recepciones_count', 'desc')
    ->first();

    $marcaMasRepetida = Recepcion::marcaMasRepetida();
    
    $montoTotal = Recepcion::montoRecaudado();

    $recaudadoMesPasado = Recepcion::recaudacionMesPasado();

    return view('home', compact('recepciones', 'equipoMasRegistrado', 'marcaMasRepetida', 'recepcionesPendientes', 'montoTotal', 'recaudadoMesPasado'));

    }
}

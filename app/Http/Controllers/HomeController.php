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
    public function index(Request $request)
    {
        if (Recepcion::exists()) {
            
            /* $equipoMasRegistrado =  */
            $datos = [];
            $estadisticasGenerales=[
                'recepcionesPendientes'=>Recepcion::recepcionesPendientes()->count(),
                'recepcionesTotales'=>Recepcion::all()->count(),
                'recepcionesFinalizadas'=>Recepcion::all()->count()-Recepcion::recepcionesPendientes()->count(),
                'modeloMasFrecuente'=>Recepcion::modeloMasFrecuente(),
                'marcaMasFrecuente'=>Recepcion::marcaMasFrecuente()->marca,
                'montoTotal'=>Recepcion::montoRecaudado(),
            ];
            $estadisticasPorMes=[];
            $recepcionesPorMes='';
            if (isset($request['anio']) && isset($request['mes'])) {
                $mes= $request['mes'];
                $anio = $request['anio'];
                /* return Recepcion::recepcionesFinalizadasEnMes($mes,$anio); */
                $estadisticasPorMes=[
                    'montoRecaudado'=>Recepcion::montoRecaudadoPorFecha($mes,$anio),
                    'marcaMasFrecuente'=>Recepcion::marcaMasFrecuentePorMes($mes,$anio),
                    'modeloMasFrecuente'=>Recepcion::modeloMasFrecuentePorMes($mes,$anio),
                    'recepcionesFinalizadas'=>Recepcion::recepcionesFinalizadasEnMes($mes,$anio),
                ];
                for ($mes = 1; $mes <= 12; $mes++) {
                    $recepciones = Recepcion::recepcionesFinalizadasEnMes($mes, $anio);
                    $datos[] = $recepciones;
                }
                $recepcionesPorMes= Recepcion::RecepcionesPorAnio($anio);
            }
            /* return $estadisticasPorMes; */
    
            /* $recaudadoMesPasado = Recepcion::recaudacionMesPasado(); */
            return view('home', compact('estadisticasGenerales','estadisticasPorMes','datos','recepcionesPorMes'));
        } else {
            return view('home');
        }


    }
}

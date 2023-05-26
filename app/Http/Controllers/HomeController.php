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
            $recepcionesPorMes1='';
            $recepcionesPorMes2='';
            $datos1[]=null;
            if (isset($request['anio1'])/*  && isset($request['mes']) */) {
                /* $mes= $request['mes']; */
                $anio1 = $request['anio1'];
                $anio2 = $request['anio2'];
                /* return Recepcion::recepcionesFinalizadasEnMes($mes,$anio1); */
                /* $estadisticasPorMes=[
                    'montoRecaudado'=>Recepcion::montoRecaudadoPorFecha($mes,$anio1),
                    'marcaMasFrecuente'=>Recepcion::marcaMasFrecuentePorMes($mes,$anio1),
                    'modeloMasFrecuente'=>Recepcion::modeloMasFrecuentePorMes($mes,$anio1),
                    'recepcionesFinalizadas'=>Recepcion::recepcionesFinalizadasEnMes($mes,$anio1),
                ]; */
                /* for ($mes = 1; $mes <= 12; $mes++) {
                    $datos1[] = Recepcion::recepcionesFinalizadasEnMes($mes, $anio1);
                } */
                if ($request['valor']=='Monto') {
                    $recepcionesPorMes1= Recepcion::MontoPorAnio($anio1);
                    $recepcionesPorMes2= Recepcion::MontoPorAnio($anio2);
                } else {
                    $recepcionesPorMes1= Recepcion::RecepcionesPorAnio($anio1);
                    $recepcionesPorMes2= Recepcion::RecepcionesPorAnio($anio2);
                }
            }
            /* return $estadisticasPorMes; */
    
            /* $recaudadoMesPasado = Recepcion::recaudacionMesPasado(); */
            return view('home', compact('estadisticasGenerales','estadisticasPorMes','datos1','recepcionesPorMes1','recepcionesPorMes2'));
        } else {
            return view('home');
        }


    }
}

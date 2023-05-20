<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;

class Recepcion extends Model
{
    protected $table = 'recepciones';
    protected $fillable = [
        'recepcionista_id',
        'equipo_id',
        'estado_id',
        'cliente_id',
        'falla',
        'accesorio',
        'fecha_recepcion',
        'fecha_entrega',
        'informe_final',
        'observacion',
        'precio',
        'garantia'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function equipo(){
        return $this->belongsTo('App\Models\Equipo');
    }
    public function estado(){
        return $this->belongsTo('App\Models\Estado');
    }
    public function revisiones(){
        return $this->hasMany(Revision::class);
    }
    public function terminada(){
        if (strcmp($this->estado->estado,'Equipo Entregado')==0) {
            return 'disabled';
        }
        return '';
    }
    public static function buscarPorId($id){
        $recepciones=Recepcion::where('id','like','%'.$id.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $recepciones;
    }

    public static function listarRecepciones($buscar){
        $recepciones=Recepcion::where('falla','like','%'.$buscar.'%')
            ->orwhere(
                'accesorio', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'id', 'like' ,'%'.$buscar.'%'
            )
            ->orwhere(
                'fecha_recepcion', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo', 'numero_serie', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica.marca', 'marca', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'equipo.caracteristica', 'modelo', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'estado', 'estado', 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,', ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(apellido,' ',nombre)"), 'like' ,'%'.$buscar.'%'
            )
            ->orwhereRelation(
                'cliente', DB::raw("CONCAT(nombre,' ',apellido)"), 'like' ,'%'.$buscar.'%'
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return $recepciones;
    }

    public static function recepcionesPendientes(){
        $recepciones = DB::table('recepciones')
                ->join('estados', 'recepciones.estado_id', '=', 'estados.id')
                ->where('estados.estado', '!=', 'Equipo Entregado')
                ->select('recepciones.*')
                ->get();
        return $recepciones;
    }

    public static function marcaMasFrecuente(){
        return Recepcion::join('equipos', 'recepciones.equipo_id', '=', 'equipos.id')
        ->join('caracteristicas', 'equipos.caracteristica_id', '=', 'caracteristicas.id')
        ->join('marcas', 'caracteristicas.marca_id', '=', 'marcas.id')
        ->groupBy('marcas.marca')
        ->select('marcas.marca', DB::raw('COUNT(*) as cantidad'))
        ->orderByDesc('cantidad')
        ->first();
    }

    public static function montoRecaudado(){
        $estadoEntregado=Estado::where('estado','Equipo Entregado')->first();
        if ($estadoEntregado) {
            return Recepcion::where('estado_id', $estadoEntregado->id)->sum('precio');
        } else {
            return 0;
        }
    }
    
    public static function recaudacionMesPasado(){
        $estadoEntregado=Estado::where('estado','Equipo Entregado')->first();
        $estadoEntregado = Estado::where('estado', 'Equipo Entregado')->first();
        $now = Carbon::now();
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();
        if ($estadoEntregado) {
            return Recepcion::where('estado_id', $estadoEntregado)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('precio');
        } else {
            return 0;
        }
    }
    
    public function recepcionTerminada(){
        if (strcmp($this->estado->estado,'Equipo Entregado')==0) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function recaudacionPorMes($mes,$anio){
        $montoTotal = DB::table('recepciones')
        ->join('estados', 'recepciones.estado_id', '=', 'estados.id')
        ->where('estados.estado', '=', 'equipo entregado')
        ->whereMonth('recepciones.fecha_entrega', '=', $mes)
        ->whereYear('recepciones.fecha_entrega', '=', $anio)
        ->sum('recepciones.precio');
        return $montoTotal;
    }
    public static function montoRecaudadoPorFecha($mes,$anio){
        return DB::table('recepciones')
                    ->join('estados', 'recepciones.estado_id', '=', 'estados.id')
                    ->where('estados.estado', '=', 'Equipo Entregado')
                    ->whereMonth('recepciones.fecha_entrega', '=', $mes)
                    ->whereYear('recepciones.fecha_entrega', '=', $anio)
                    ->sum('recepciones.precio');
    }
    public static function marcaMasFrecuentePorMes($mes, $anio){
        $marca= Recepcion::join('equipos', 'recepciones.equipo_id', '=', 'equipos.id')
            ->join('caracteristicas', 'equipos.caracteristica_id', '=', 'caracteristicas.id')
            ->join('marcas', 'caracteristicas.marca_id', '=', 'marcas.id')
            ->whereMonth('recepciones.created_at', $mes)
            ->whereYear('recepciones.created_at', $anio)
            ->groupBy('marcas.marca')
            ->select('marcas.marca', DB::raw('COUNT(*) as cantidad'))
            ->orderByDesc('cantidad')
            ->first()/* ->marca */;
        if ($marca!=null) {
            return $marca->marca;
        } else {
            return '';
        }
    }
    public static function modeloMasFrecuente(){
        return Equipo::withCount('recepciones')
                ->orderBy('recepciones_count', 'desc')
                ->first()->modelo;
    }

    public static function modeloMasFrecuentePorMes($mes, $anio){
        $equipo= Equipo::whereHas('recepciones', function($query) use($mes, $anio){
                $query->whereYear('fecha_recepcion', $anio)
                    ->whereMonth('fecha_recepcion', $mes);
            })
            ->withCount(['recepciones' => function($query) use($mes, $anio){
                $query->whereYear('fecha_recepcion', $anio)
                    ->whereMonth('fecha_recepcion', $mes);
            }])
            ->orderBy('recepciones_count', 'desc')
            ->first()/*  */;
            if ($equipo!=null) {
                return $equipo->caracteristica->modelo;
            } else {
                return '';
            }
    }

    public static function recepcionesFinalizadasEnMes($mes, $anio) {
        $recepciones = Recepcion::join('estados', 'recepciones.estado_id', '=', 'estados.id')
        ->where('estados.estado', 'Equipo Entregado')
        ->whereRaw('MONTH(recepciones.fecha_entrega) = ?', [$mes])
        ->whereYear('recepciones.fecha_entrega', $anio)->get()
        ->count();
        return $recepciones;
    }
    public static function RecepcionesPorMes($mes,$anio){
        $montoTotal = DB::table('recepciones')
        ->whereMonth('recepciones.fecha_recepcion', '=', $mes)
        ->whereYear('recepciones.fecha_recepcion', '=', $anio)->count();
        return $montoTotal;
    }

    public static function RecepcionesPorAnio($anio){
        $puntos = [];
        for ($i=1; $i < 13; $i++) { 
            $puntos[]=['name'=>$i,'y'=>Recepcion::RecepcionesPorMes($i,$anio)];
        }
        $puntos = json_encode($puntos);
        return $puntos;
    }
}

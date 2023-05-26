@extends('navegacion')

@section('titulo','Home')

@php
    setlocale(LC_TIME, 'es_ES');
    use App\Models\Recepcion;
    @endphp

@section('contenido')
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
    <h2 class="text-center m-5 bg-primary" style="color:white" >Bienvenido: 
        @if (auth()->user()->tieneRol(['admin']))
            Administrador
        @else
            @if (auth()->user()->tieneRol(['recepcionista']))
                Recepcionista        
            @endif
            @if (auth()->user()->tieneRol(['tecnico']))
                Técnico        
            @endif
        @endif
    {{auth()->user()->nombre}} </h2>
    <div class="card border-info mb-3 justify-content-center mx-auto" style="width: 60em">
        <div class="m-0 p-0 card-header text-center">
            <h4 class="m-0 p-1 card-title">
                    Estadísticas.
            </h4>
        </div>
        <div class="card-body">
            <div class="row">
                @if (isset($estadisticasGenerales))
                    
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Recepciones totales:</b> {{($estadisticasGenerales)?$estadisticasGenerales['recepcionesTotales']:'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones pendientes:</b> {{($estadisticasGenerales)?$estadisticasGenerales['recepcionesPendientes']:'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones finalizadas:</b> {{($estadisticasGenerales)?$estadisticasGenerales['recepcionesFinalizadas']:'No se registraron recepciones.'}}</p></div>

                </div>
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Modelo más frecuente:</b> {{($estadisticasGenerales['modeloMasFrecuente'])?$estadisticasGenerales['modeloMasFrecuente']->modelo.' ('.$estadisticasGenerales['modeloMasFrecuente']->marca.')':'No se registraron equipos'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Marca más frecuente:</b> {{($estadisticasGenerales)?$estadisticasGenerales['marcaMasFrecuente']:'No se registro ningun Equipo'}}</p></div>
                    @if (auth()->user()->tieneRol(['admin']))
                    <div class="w-auto"><p class="card-text"><b>Recaudación total:</b> {{($estadisticasGenerales['montoTotal'])?$estadisticasGenerales['montoTotal']:''}}</p></div>
                    {{-- <div class="w-auto"><p class="card-text"><b>Recaudación del mes pasado:</b> {{($recaudadoMesPasado)?$recaudadoMesPasado:''}}</p></div> --}}
                    @endif
                </div>
                @else
                    <p class="text-center">Aún no se cargó ninguna recepción</p>
                @endif
            </div>
        </div>
    </div>
    <div class="card border-info mb-3 justify-content-center mx-auto" style="width: 60em">
        <div class="m-0 p-0 card-header text-center">
            <div class="row pt-1">
                <div class="col-7">
                    <h4 class="m-0 p-1 card-title">
                            Ver Estadisticas por año:
                    </h4>
                </div>
                <div class="col-5">
                    <form action="#">
                        <select name="anio1">
                            <option value="">Año 1</option>
                            @for ($i = date('Y'); $i >= 2022; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="anio2">
                            <option value="">Año 2</option>
                            @for ($i = date('Y'); $i >= 2022; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="valor" id="">
                            <option value="Recepciones">Recepciones</option>
                            <option value="Monto">Monto</option>
                        </select>
                        {{-- <select name="mes">
                            <option value="" selected>Mes</option>
                            @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ array_key_exists($i-1, trans('date.months')) ? trans('date.months')[$i-1] : '' }}</option>
                            @endfor
                        </select>    --}}                     
                        <input type="submit" value="Ver">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="row">
                @if (isset($estadisticasPorMes['marcaMasFrecuente']))
                    
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Recepciones totales:</b> {{($recepciones)?$recepciones->count():'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones pendientes:</b> {{($recepcionesPendientes)?$recepcionesPendientes->count():'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones Finalizada:</b> {{(isset($estadisticasPorMes['recepcionesFinalizadas']))?$estadisticasPorMes['recepcionesFinalizadas']:''}}</p></div>

                </div>
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Modelo más común:</b> {{($estadisticasPorMes['modeloMasFrecuente'])?$estadisticasPorMes['modeloMasFrecuente']:'No hay registros en esta fecha'}} </p></div>
                    <div class="w-auto"><p class="card-text"><b>Marca más común:</b> {{($estadisticasPorMes['marcaMasFrecuente'])?$estadisticasPorMes['marcaMasFrecuente']:'No hay registros en esta fecha'}}</p></div>
                    @if (auth()->user()->tieneRol(['admin']))
                    <div class="w-auto"><p class="card-text"><b>Recaudación total:</b> {{(isset($estadisticasPorMes['montoRecaudado']))?$estadisticasPorMes['montoRecaudado']:''}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recaudación del mes pasado:</b> {{($recaudadoMesPasado)?$recaudadoMesPasado:''}}</p></div>
                    @endif
                </div>
                @else
                    <p class="text-center">Seleccione una fecha</p>
                @endif
            </div> --}}
            <div id="container" class="">
                <div id="container" class="col-8">
                    @if ($recepcionesPorMes1!='' || $recepcionesPorMes2!='')
                    @if ($_GET['anio1']!=null || $_GET['anio2']!=null)   
                    <script src="{{ asset('js/highcharts.js') }}"></script>
                    <script src="{{ asset('js/highcharts-more.js') }}"></script>
                    <script>
                        var datos1 = {!! $recepcionesPorMes1 !!};
                        var datos2 = {!! $recepcionesPorMes2 !!};
                        Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Recepciones por mes'
                        },
                        xAxis: {
                            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                        },
                        yAxis: {
                            title: {
                                text: '<?php echo $_GET['valor']; ?>'
                            }
                        },
                        /* series: [{
                            name: 'Número de Recepciones',
                            data: datos1
                        }] */
                        series: [{
                            name: 'Año <?php echo $_GET['anio1']; ?>',
                            data: datos1
                        }, {
                            name: 'Año <?php echo $_GET['anio2']; ?>',
                            data: datos2
                        }]
                    });
                    </script>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection


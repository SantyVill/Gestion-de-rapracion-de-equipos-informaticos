@extends('navegacion')

@section('titulo','Home')

@section('contenido')
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
                @if (isset($recepcion))
                    
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Recepciones totales:</b> {{($recepciones)?$recepciones->count():'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones pendientes:</b> {{($recepcionesPendientes)?$recepcionesPendientes->count():'No se registraron recepciones.'}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recepciones terminadas:</b> {{($recepcionesPendientes && $recepciones)?$recepciones->count()-$recepcionesPendientes->count():'No se registraron recepciones.'}}</p></div>

                </div>
                <div class="col-6">
                    <div class="w-auto"><p class="card-text"><b>Modelo más común:</b> {{($equipoMasRegistrado)?$equipoMasRegistrado->caracteristica->modelo:'No se registraron equipos'}} ({{ ($equipoMasRegistrado)?$equipoMasRegistrado->caracteristica->marca->marca:'No se registraron equipos'}})</p></div>
                    <div class="w-auto"><p class="card-text"><b>Marca más común:</b> {{($marcaMasRepetida)?$marcaMasRepetida->marca:'No se registro ningun Equipo'}}</p></div>
                    @if (auth()->user()->tieneRol(['admin']))
                    <div class="w-auto"><p class="card-text"><b>Recaudación total:</b> {{($montoTotal)?$montoTotal:''}}</p></div>
                    <div class="w-auto"><p class="card-text"><b>Recaudación del mes pasado:</b> {{($recaudadoMesPasado)?$recaudadoMesPasado:''}}</p></div>
                    @endif
                </div>
                @else
                    <p class="text-center">Aun no se cargo ninguna recepción</p>
                @endif
            </div>
        </div>
    </div>
    <br>
@endsection
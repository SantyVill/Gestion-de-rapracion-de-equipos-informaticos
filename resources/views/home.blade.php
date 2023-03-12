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
        <div class="card-header text-center">
            <h4 class="card-title">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Ver estadísticas.
                </button>
            </h4>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="card-body">
                <div class="row">
                    <div class="col-6"><p class="card-text"><b>N° de recepciones:</b> {{($recepciones)?$recepciones->count():'No se registraron recepciones.'}}</p></div>
                    <div class="col-6"><p class="card-text"><b>Recaudación total:</b> {{($recepciones)?$recepciones->sum('precio'):''}}</p></div>
                </div>
                <div class="row">
                    <div class="col-6"><p class="card-text"><b>Modelo más concurrente:</b> {{($equipoMasRegistrado)?$equipoMasRegistrado->caracteristica->modelo:'No se registraron equipos'}} ({{ ($equipoMasRegistrado)?$equipoMasRegistrado->caracteristica->marca->marca:'No se registraron equipos'}})</p></div>
                    <div class="col-6"><p class="card-text"><b>Marca mas concurrente:</b> {{($marcaMasRepetida)?$marcaMasRepetida->marca:'No se registro ningun Equipo'}}</p></div>
                </div>               
                
            </div>
        </div>
    </div>
    <br>
@endsection
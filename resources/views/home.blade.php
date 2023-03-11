@extends('navegacion')

@section('titulo','Home')

@section('contenido')
    <h2 class="text-center m-5">Bienvenido 
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
                    <div class="col-6"><p class="card-text"><b>N° de recepciones:</b> {{$recepciones->count()}}</p></div>
                    <div class="col-6"><p class="card-text"><b>Recaudación total:</b> {{$recepciones->sum('precio')}}</p></div>
                </div>
                <div class="row">
                    <div class="col-6"><p class="card-text"><b>Modelo más concurrente:</b> {{$equipoMasRegistrado->caracteristica->modelo}} ({{ $equipoMasRegistrado->caracteristica->marca->marca }})</p></div>
                    <div class="col-6"><p class="card-text"><b>Marca mas concurrente:</b> {{$marcaMasRepetida->marca}}</p></div>
                </div>               
                
            </div>
        </div>
    </div>
    <br>
@endsection
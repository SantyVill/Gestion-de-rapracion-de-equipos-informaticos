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
    <br>
@endsection
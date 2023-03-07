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
    <div class="card text-center">
      <img class="card-img-top" src="holder.js/100px180/" alt="Title">
      <div class="card-body">
        <h4 class="card-title">Title</h4>
        <p class="card-text">Body</p>
      </div>
    </div>
    <br>
@endsection
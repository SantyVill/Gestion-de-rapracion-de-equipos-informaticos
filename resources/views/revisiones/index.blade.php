@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')

    <div class="container">
        <div class="">
            <form class="form-inlinefloat-right">
                <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Equipo" aria-label="Search" value="">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Numero de Serie</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th colspan="2" scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td><a href="{{route('equipos.show',$equipo)}}">Ver</a></td>
            {{-- <td><form method="POST" action="{{route('recepciones.store')}}">
                @csrf
                <input type="submit" value="Agregar a recepcion">
                <input type="number" name="equipo_id" value="{{$equipo['id']}}" hidden>
            </form></td> --}}
            {{-- <a href="{{route('recepciones.create',$equipo)}}">Agregar a recepcion</a> --}}
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
@endsection
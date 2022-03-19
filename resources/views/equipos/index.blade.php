@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Numero de Serie</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td><a href="{{route('equipos.show',$equipo)}}">Ver</a></td>
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
@endsection
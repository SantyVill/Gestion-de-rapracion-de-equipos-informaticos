@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')
    <h1>Aqui se mostraran los equipos registrados</h1>
    <table>
        <tr>
            <th>Numero de Serie</th><th>Tipo</th><th>Marca</th><th>Falla</th><th>Modelo</th><th>Accion</th>
        </tr>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->tipo}}</td>
            <td>{{$equipo->marca}}</td>
            <td>{{$equipo->fallas}}</td>
            <td>{{$equipo->modelo}}</td>
            <td><a href="{{route('equipos.show',$equipo)}}">Ver</a></td>
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
@endsection
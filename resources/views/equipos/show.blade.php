@extends('navegacion')

@section('titulo','Ver Equipo')

@section('contenido')
    <table>
        <tr>
            <th>Id</th><th>Numero de Serie</th><th>Tipo</th><th>Marca</th><th>Falla</th><th>Modelo</th><th>Observacion</th><th scope="2">Accion</th>
        </tr>
        <tr>
            <td>{{$equipo->id}}</td>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->tipo}}</td>
            <td>{{$equipo->marca}}</td>
            <td>{{$equipo->fallas}}</td>
            <td>{{$equipo->modelo}}</td>
            <td>{{$equipo->observacion}}</td>
            <td><a href="{{route('equipos.edit',$equipo)}}">Editar</a></td>
            {{-- <td><a href="{{route('equipos.destroy',$equipo)}}">Eliminar</a></td> --}}
            <td>
                <form method="POST" action="{{route('equipos.destroy',$equipo)}}">
                    @csrf @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </td>
        </tr>
    </table>
@endsection
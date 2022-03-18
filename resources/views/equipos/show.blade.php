@extends('navegacion')

@section('titulo','Ver Equipo')

@section('contenido')
    <table>
        <tr>
            <th>Id</th><th>Numero de Serie</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Observacion</th><th scope="2">Accion</th>
        </tr>
        <tr>
            <td>{{$equipo->id}}</td>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica()->tipo()->tipo}}</td>
            <td>{{$equipo->caracteristica()->marca()->marca}}</td>
            <td>{{$equipo->caracteristica()->modelo}}</td>
            <td>{{$equipo->observacion}}</td>
            <td><a href="{{route('equipos.edit',$equipo)}}">Editar</a></td>
            {{-- <td><a href="{{route('equipos.destroy',$equipo)}}">Eliminar</a></td> --}}
            <td>
                <form method="POST" action="{{route('equipos.destroy',$equipo)}}">
                    @csrf @method('DELETE')
                    <button>Eliminar1</button>
                </form>
            </td>
        </tr>
    </table>
@endsection
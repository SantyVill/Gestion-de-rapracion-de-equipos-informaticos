@extends('navegacion')

@section('titulo','Ver Equipo')

@section('contenido')
    <table class="table table-striped table-bordered">
        <tr>
            <th>Id</th><th>Numero de Serie</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Observacion</th>
            <th colspan="2">Accion</th>
        </tr>
        <tr>
            <td>{{$equipo->id}}</td>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td>{{$equipo->observacion}}</td>
            <td><a href="{{route('equipos.edit',$equipo)}}" class="btn btn-primary">Editar</a></td>
            {{-- <td><a href="{{route('equipos.destroy',$equipo)}}">Eliminar</a></td> --}}
            <td>
                <form method="POST" action="{{route('equipos.destroy',$equipo)}}">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar1</button>
                </form>
            </td>
        </tr>
    </table>
@endsection
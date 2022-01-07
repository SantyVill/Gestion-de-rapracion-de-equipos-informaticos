@extends('navegacion')

@section('titulo','Ver Cliente')

@section('contenido')
    <table>
        <tr>
            <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
            <th>Correo Electronico</th><th>Obs:</th>
        </tr>
        <tr>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->apellido}}</td>
            <td>{{$cliente->dni}}</td>
            <td>{{$cliente->telefono1}}</td>
            <td>{{$cliente->telefono2}}</td>
            <td>{{$cliente->direccion}}</td>
            <td>{{$cliente->mail}}</td>
            <td>{{$cliente->observacion}}</td>
            <td><a href="{{route('clientes.edit',$cliente)}}">Editar</a></td>
            {{--<td><a href="{{route('clientes.destroy',$cliente)}}">Eliminar</a></td>--}}
            <td>
                <form method="POST" action="{{route('clientes.destroy',$cliente)}}">
                    @csrf @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </td>
        </tr>
    </table>
@endsection
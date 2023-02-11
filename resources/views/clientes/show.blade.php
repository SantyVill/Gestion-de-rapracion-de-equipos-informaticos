@extends('navegacion')

@section('titulo','Ver Cliente')

@section('contenido')
    <table class="table table-striped table-bordered">
        <tr>
            <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
            <th>Correo Electronico</th><th>Obs:</th><th colspan="2" class="text-center">Acciones</th>
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
            <td><a href="{{route('clientes.edit',$cliente)}}" class="btn btn-primary">Editar</a></td>
            
            <td>
                <form method="POST" action="{{route('clientes.destroy',$cliente)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td>
            {{-- <td>
                <form method="POST" action="{{route('equipos.destroy',$equipo)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td> --}}
        </tr>
    </table>
@endsection
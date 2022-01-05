@extends('navegacion')

@section('titulo','Lista de clientes')

@section('contenido')
    <h1>Aqui se mostrara la lista de clientes registrados</h1> 
    <table>
        <tr>
            <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
            <th>Correo Electronico</th><th>Obs:</th>
        </tr>
        @forelse ($clientes as $cliente)
        <tr>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->apellido}}</td>
            <td>{{$cliente->dni}}</td>
            <td>{{$cliente->telefono1}}</td>
            <td>{{$cliente->telefono2}}</td>
            <td>{{$cliente->direccion}}</td>
            <td>{{$cliente->mail}}</td>
            <td>{{$cliente->observacion}}</td>
            {{-- <td><a href="{{route('equipos.show',$equipo)}}">Ver</a></td> --}}
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>       
@endsection
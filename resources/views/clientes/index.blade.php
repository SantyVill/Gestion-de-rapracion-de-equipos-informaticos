@extends('navegacion')

@section('titulo','Lista de clientes')

@section('contenido')
    <h1>Aqui se mostrara la lista de clientes registrados</h1> 
    <table>
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
                <th>Correo Electronico</th><th>Obs:</th><th colspan="2">Accion</th>
            </tr>
       {{-- @endif--}}
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
            <td><a href="{{route('clientes.show',$cliente)}}">Ver</a></td>
            <td><a href="{{route('recepciones.create',[$equipo,$cliente])}}">Agregar a recepcion</a></td>
            {{-- <td><a href="{{url('recepciones.create', ['equipo_id' => $equipo->id, 'cliente_id' => $cliente->id])}}">Agregar a recepcion</a></td> --}}
        </tr>
        @empty
            <p>No se registró ningún cliente</p>
        @endforelse
    </table>       
@endsection
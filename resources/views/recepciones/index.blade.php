@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <h1>Aqui se mostrara la lista de las recepciones</h1>
    <table class="table table-striped table-bordered">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Modelo</th><th>Marca</th><th>Serie</th><th>Fecha Recepción</th>
                <th>Falla:</th> <th>Cliente</th> <th colspan="2">Accion</th>
            </tr>
       {{-- @endif--}}
        @forelse ($recepciones as $recepcion)
        <tr>
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            <td>{{$recepcion->equipo->numero_serie}}</td>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->falla}}</td>

            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            <td><a href="{{route('recepciones.show',$recepcion)}}">Ver</a></td>
        
            {{-- <td><a href="{{url('recepciones.create', ['equipo_id' => $equipo->id, 'cliente_id' => $cliente->id])}}">Agregar a recepcion</a></td> --}}
        </tr>
        @empty
            <p>No se registró ninguna recepción</p>
        @endforelse
    </table>       
@endsection

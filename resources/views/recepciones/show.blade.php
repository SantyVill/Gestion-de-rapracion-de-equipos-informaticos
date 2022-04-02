@extends('navegacion')

@section('titulo','Ver Recepcion')

@section('contenido')
    <h1>Aqui se mostrara la lista de las recepciones</h1>
    <table class="table table-striped table-bordered">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Serie</th>
                <th>Fecha Recepción</th>
                <th>Estado</th>
                <th>Observacíon</th>
                <th>Falla:</th>
                <th>Cliente</th>
                <th colspan="2">Accion</th>
            </tr>
       {{-- @endif--}}
        <tr>
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            <td>{{$recepcion->equipo->numero_serie}}</td>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->estado->estado}}</td>
            <td>{{$recepcion->observacion}}</td>
            <td>{{$recepcion->falla}}</td>

            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            <td><a href="{{route('recepciones.edit',$recepcion)}}">Editar</a></td>
        
            <td>
                <form method="POST" action="{{route('recepciones.destroy',$recepcion)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                {{-- <script>window.confirm("¿Está seguro que quiere borrar?")     --}}
                    <button class="btn btn-danger">Eliminar</button>
                    @csrf @method('DELETE')
                {{-- </script> --}}
                </form>
            </td>
        </tr>
    </table>       
@endsection

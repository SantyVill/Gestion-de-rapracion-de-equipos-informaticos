@extends('navegacion')

@section('titulo','Ver Recepcion')

@section('contenido')
    <h1>Aqui se mostrara la lista de las recepciones</h1>
    <table class="table table-striped table-bordered">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Fecha Recepción</th>
                <th>Estado</th>
                <th>Observacíon</th>
                <th>Falla:</th>
                <th>Cliente</th>
                <th colspan="3" class="text-center">Accion</th>
            </tr>
       {{-- @endif--}}
        <tr>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->estado->estado}}</td>
            <td>{{$recepcion->observacion}}</td>
            <td>{{$recepcion->falla}}</td>

            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            <td><button type="button" class="btn btn-warning">
                <a class="link-dark" href="{{route('recepciones.edit',$recepcion)}}">Editar</a>
            </button></td>
            <td>
                <button type="button" class="btn btn-primary">
                    <a class="link-light" href="{{route('revisiones.create',$recepcion)}}">Agregar Revision</a>
                </button>
            </td>
        
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
    <div class="container">
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3" class="text-center">Equipo</th>
                    </tr>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Serie</th>
                    </tr>
                    <tr>
                        <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
                        <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
                        <td><a href="{{route('equipos.show',$recepcion->equipo)}}">{{$recepcion->equipo->numero_serie}}</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <table class="table  table-bordered"> 
        <thead class="thead-dark">
        <tr>
            <th>Notas</th>
            <th>Fecha</th>
            <th>Usuario</th>
        </tr>
        </thead>
        @forelse ($recepcion->revisiones as $revision)
            <tr  class="{{($revision->tecnico_id==auth()->user()->id)?'table-info':'table-success'}}">
                <td>{{$revision->nota}}</td>
                <td>{{$revision->fecha}}</td>
                <td>{{$revision->user->apellido.', '.$revision->user->nombre}}</td> 
                {{-- <td>{{User::find($revision->tecnico_id)->apellido.', '.User::find($revision->tecnico_id)->nombre}}</td> --}}
            </tr>        
        @empty
            <p>No se agregó ninguna revisión</p>
        @endforelse
        
    </table> 
    {{-- {{dd($recepcion)}} --}} 
@endsection

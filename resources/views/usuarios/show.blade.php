@extends('navegacion')

@section('titulo','Ver Usuario')

@section('contenido')
    <table class="table table-striped table-bordered">
        <tr>
            <th>Id</th><th>Apellido y Nombre</th><th>E-mail</th><th>Roles</th>
            <th colspan="2">Accion</th>
        </tr>
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->apellido.', '.$user->nombre}}</td>
            <td>{{$user->email}}</td>
            <td>
                @forelse ($user->roles as $rol)
                {{$rol->rol}}
                @empty
                    No tiene roles
                @endforelse
            </td>
            <td><a href="{{route('usuarios.edit',$user)}}" class="btn btn-primary">Editar</a></td>
            
            <td>
                <form method="POST" action="{{route('usuarios.destroy',$user)}}"onclick="return confirm('¿Está seguro que desea borrar este usuario?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        
    </table>
    
    <h4>Recepciones: </h4>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Modelo</th><th>Marca</th><th>Serie</th><th>Fecha Recepción</th>
            <th>Falla:</th> <th>Cliente</th> <th colspan="2">Accion</th>
        </tr>
        @forelse ($user->recepciones->unique() as $recepcion)
        <tr>
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            <td>{{$recepcion->equipo->numero_serie}}</td>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->falla}}</td>

            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            <td><a href="{{route('recepciones.show',$recepcion)}}">Ver</a></td>
        </tr>
        @empty
            <p>No se registró ninguna recepción</p>
        @endforelse
    </table>
@endsection
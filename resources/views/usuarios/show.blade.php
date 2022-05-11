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
@endsection
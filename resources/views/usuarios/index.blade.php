@extends('navegacion')

@section('titulo','Lista de usuarios')

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-7">
                <a href="{{route('usuarios.create')}}" class="nav-link}}">
                    <button type="button" class="btn btn-success">Registrar Usuario</button>
                </a>
            </div>
            <div class="col-5">
                <form class="form-inlinefloat-right">
                    <div class="row">
                        <div class="col-7">
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Usuario" aria-label="Search" value="{{$buscar}}">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h3 class="text-center">Lista de Usuarios</h3>
    <table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">
        <thead>
            <tr>
                <th scope="col">Apellido y Nombre</th>
                <th scope="col">E-mail</th>
                <th scope="col">Roles</th>
                <th colspan="2" scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($users as $usuario)
        <tr>
            <td>{{$usuario->apellido.', '.$usuario->nombre}}</td>
            <td>{{$usuario->email}}</td>
            <td>
                @forelse ($usuario->roles as $rol)
                    {{$rol->rol}}
                @empty
                    No tiene roles
                @endforelse
            </td>
            <td><a href="{{route('usuarios.show',$usuario)}}">Ver</a></td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No se encontró ningún usuario.</td>
        </tr>
        @endforelse
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->appends($_GET)->links() }}
    </div>
@endsection
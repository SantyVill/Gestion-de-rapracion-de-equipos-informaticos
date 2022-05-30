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
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Usuario" aria-label="Search" value="">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered">
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
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
@endsection
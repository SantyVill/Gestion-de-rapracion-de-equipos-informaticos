@extends('navegacion')

@section('titulo','Lista de usuarios')

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-7">
                <a href="{{route('usuarios.create')}}" class="nav-link}}">
                    <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                        </svg>
                        Registrar Usuario
                    </button>
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
    <h3 class="text-center bg-dark " style="color:rgb(170 170 170">Usuarios</h3>
    <div class=" row justify-content-center">
        <table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded w-auto">
            <thead>
                <tr class="text-center">
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
                <td class="p-1 text-center col-1"><a href="{{route('usuarios.show',$usuario)}}" class="btn btn-primary">Ver</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No se encontró ningún usuario.</td>
            </tr>
            @endforelse
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $users->appends($_GET)->links() }}
    </div>
@endsection
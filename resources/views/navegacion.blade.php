<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        <h1 class="text-center">Gestion de reparaciones</h1>
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <nav class="navbar navbar-expand-lg navbar-light bg-light text-left">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul  class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ setActiva('/') }}">Inicio</a>
                </li>{{-- funcion setActiva: https://www.youtube.com/watch?v=Lx2bAjM3s80&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16 --}}
                <li class="nav-item">
                    <a href="{{route('equipos.index')}}" class="nav-link {{ setActiva('equipos') }}">Equipos</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('equipos.create')}}" class="nav-link {{ setActiva('equipos/create') }}">Registrar Equipos</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('clientes.index')}}" class="nav-link {{ setActiva('cliente/index') }}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('clientes.create')}}" class="nav-link {{ setActiva('cliente/create') }}">Registrar Clientes</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('recepciones.index')}}" class="nav-link {{ setActiva('recepciones') }}">Recepciones</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('recepciones.create')}}" class="nav-link {{ setActiva('recepciones/create') }}">Registrar Recepcion</a>
                </li>
                {{-- <li class="{{ setActiva('equipos.create.*') }}"><a href="{{route('clientes.compras')}}">Clietnes</a></li> --}}
                @if (auth()->check())
                    @if (auth()->user()->esAdmin())
                        <li class="nav-item">
                            <a href="{{route('precios.index')}}" class="nav-link {{ setActiva('precios') }}">Lista de precios</a>
                        </li>
                    @endif
                    {{-- @foreach (auth()->user()->roles as $rol)
                        @if ($rol->rol==="admin")
                            <li class="{{ setActiva('recepciones.*') }}"><a href="{{route('precios.index')}}">Lista de precios</a></li>
                        @endif
                    @endforeach --}}
                @endif
                <div class="text-end">
                    @if (auth()->check())
                    <li>Usuario: {{auth()->user()->apellido.", ".auth()->user()->nombre/* ." Roles: " */}} {{-- figura quien estaría logueado con su rol/es --}}
                        {{-- @foreach (auth()->user()->roles as $rol)
                            {{$rol->rol}}
                            @endforeach --}}
                        </li>
                        <li><a href="{{route('login.destroy')}}">Cerrar sesión</a></li>
                        @else
                        <li><a href="{{route('login.index')}}">Log in</a></li>
                        @endif
                </div>
                        <li><a href="{{route('registro.index')}}">Registrar usuario</a></li>
            </ul>
        </nav>
        </div>
        </div>
        {{-- <nav class="">
            <ul>
            </ul>
            <div>@dd(auth()->user()->roles()))</div>
        </nav> --}}
    </header>
    <div class="container">
        @yield('contenido')
    </div>
    @if(session()->has('message'))
        <div>
            {{ session()->get('message') }}
        </div>
    @endif
</body>
</html>
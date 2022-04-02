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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul>
                @if (auth()->check())
                    <li>Nombre de usuario: {{auth()->user()->apellido.", ".auth()->user()->nombre." Roles: "}} {{-- figura quien estaría logueado con su rol/es --}}
                    @foreach (auth()->user()->roles as $rol)
                        {{$rol->rol}}
                    @endforeach</li>
                    <li><a href="{{route('login.destroy')}}">Cerrar sesión</a></li>
                @else
                    <li><a href="{{route('login.index')}}">Log in</a></li>
                @endif
                <li><a href="{{route('registro.index')}}">Registrar usuario</a></li>
            </ul>
            {{-- <div>@dd(auth()->user()->roles()))</div> --}}
        </nav>
        <h1>Gestion de reparaciones</h1>
    </header>
    <nav>
        <ul>
            <li class="{{ setActiva('home.*') }}"><a href="/">Inicio</a></li>{{-- funcion setActiva: https://www.youtube.com/watch?v=Lx2bAjM3s80&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16 --}}
            <li class="{{ setActiva('equipos.*') }}"><a href="{{route('equipos.index')}}">Equipos</a></li>
            <li class="{{ setActiva('equipos.*') }}"><a href="{{route('equipos.create')}}">Registrar Equipos</a></li>
            <li class="{{ setActiva('clientes.*') }}"><a href="{{route('clientes.index')}}">Clientes</a></li>
            <li class="{{ setActiva('clientes.*') }}"><a href="{{route('clientes.create')}}">Registrar Clientes</a></li>
            <li class="{{ setActiva('recepciones.*') }}"><a href="{{route('recepciones.index')}}">Recepciones</a></li>
            <li class="{{ setActiva('recepciones.*') }}"><a href="{{route('recepciones.create')}}">Registrar Recepcion</a></li>
            {{-- <li class="{{ setActiva('equipos.create.*') }}"><a href="{{route('clientes.compras')}}">Clietnes</a></li> --}}
        </ul>
    </nav>
    @yield('contenido')
</body>
</html>
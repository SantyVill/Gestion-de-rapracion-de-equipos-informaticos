<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
</head>
<body>
    <h1>Gestion de reparaciones</h1>
    <nav>
        <ul>
            <li class="{{ setActiva('home.*') }}"><a href="/">Inicio</a></li>{{-- funcion setActiva: https://www.youtube.com/watch?v=Lx2bAjM3s80&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16 --}}
            <li class="{{ setActiva('equipos.*') }}"><a href="{{route('equipos.index')}}">Equipos</a></li>
            <li class="{{ setActiva('equipos.*') }}"><a href="{{route('equipos.create')}}">Registrar Equipos</a></li>
            <li class="{{ setActiva('equipos.*') }}"><a href="{{route('clientes.index')}}">Clientes</a></li>
            {{-- <li class="{{ setActiva('equipos.create.*') }}"><a href="{{route('clientes.compras')}}">Clietnes</a></li> --}}
        </ul>
    </nav>
    @yield('contenido')
</body>
</html>
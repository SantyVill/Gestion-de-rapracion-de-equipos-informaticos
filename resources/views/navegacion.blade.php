<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        <h1 class="text-center">Gestion de reparaciones</h1>

        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark mb-3">
          <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                  <a href="/" class="nav-link {{ setActiva('/') }}">Inicio</a>
                </li>
                
                
                {{-- =============LINKS DE EQUIPOS============= --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('equipos.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Equipos
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item">
                        <a href="{{route('equipos.index')}}" class="dropdown-item nav-link">Lista de Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('equipos.create')}}" class="dropdown-item nav-link">Registrar Equipo</a>
                    </li>
                  </ul>
                </li>
                    
                {{-- =============LINKS DE CLIENTES============= --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('clientes.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Clientes
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item">
                        <a href="{{route('clientes.index')}}" class="dropdown-item nav-link">Lista de Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('clientes.create')}}" class="dropdown-item nav-link">Registrar Cliente</a>
                    </li>
                  </ul>
                </li>
                    
                {{-- =============LINKS DE RECEPCIONES============= --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('recepciones.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Recepciones
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item">
                        <a href="{{route('recepciones.index')}}" class="dropdown-item nav-link">Lista de Recepciones</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('recepciones.create')}}" class="dropdown-item nav-link">Registrar Recepcion</a>
                    </li>
                  </ul>
                </li>

                {{-- =============LINKS DE USUARIOS============= --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('usuarios.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuarios
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item ">
                        <a href="{{route('usuarios.index')}}"  class="nav-link {{ setActiva('usuarios.*') }}">Lista de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('usuarios.create')}}" class="dropdown-item nav-link">Registrar usuario</a>
                    </li>
                  </ul>
                </li>

                
                {{-- =============LINKS DE LISTA DE PRECIOS============= --}}
                <li class="nav-item">
                    <a href="{{route('marcas.index')}}" class="nav-link {{ setActiva('marcas.*') }}">Lista de precios</a>
                </li>
                
              </ul>
              @if (auth()->check())
              <div class="me-5">
                  <a href="{{route('usuarios.show',auth()->user())}}" class="nav-link link-light">
                    {{auth()->user()->apellido.", ".auth()->user()->nombre/* ." Roles: " */}} {{-- figura quien estaría logueado con su rol/es --}}
                  </a> 
              </div>
              <a href="{{route('login.destroy')}}"  class="nav-link link-light" >Cerrar sesión</a>
              @else
              <a href="{{route('login.index')}}" class="nav-link link-light">Log in</a>
              @endif
            </div>
          </div>
        </nav>



    </header>
    <div class="container-fluid">
        @yield('contenido')
    </div>
    @if(session()->has('message'))
        <div>
            {{ session()->get('message') }}
        </div>
    @endif
@extends('footer')
</body>
</html>
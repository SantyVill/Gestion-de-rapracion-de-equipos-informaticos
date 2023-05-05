<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/MiEstilo.css') }}" rel="stylesheet">
    <title>@yield('titulo')</title>
</head>
<body {{-- class="bd-green-500" --}} style="background-color: rgb(232 232 232)">
    <header>
        <h2 class="text-center m-0 {{-- text-light --}}" style="color: rgb(185, 185, 185);background-color: rgb(10, 10, 10)"><b>Gestión de Reparaciones</b></h2>

        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark mb-2 p-0">
          <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                  <a href="/" class="nav-link {{ setActiva('/') }}">
                    Inicio
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                      <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                    </svg>
                  </a>
                </li>
                    
                {{-- =============LINKS DE RECEPCIONES============= --}}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('recepciones.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Recepciones
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                      <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                      <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z"/>
                    </svg>
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item">
                        <a href="{{route('recepciones.index')}}" class="dropdown-item nav-link">Lista de Recepciones</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('recepciones.create')}}" class="dropdown-item nav-link">Nueva Recepcion</a>
                    </li>
                  </ul>
                </li>
                    
                {{-- =============LINKS DE CLIENTES============= --}}
                @if (auth()->user()->tieneRol(['admin','recepcionista']))
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('clientes.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Clientes
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                      <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                    </svg>
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
                @endif
                
                
                {{-- =============LINKS DE EQUIPOS============= --}}
                @if (auth()->user()->tieneRol(['admin','recepcionista','tecnico']))
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('equipos.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Equipos
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                      <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                      <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
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
                @endif

                {{-- =============LINKS DE USUARIOS============= --}}
                @if (auth()->user()->tieneRol(['admin']))
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle {{ setActiva('usuarios.*') }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuarios
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                      <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                      <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                    </svg>
                  </a>
                  <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <li class="nav-item ">
                        <a href="{{route('usuarios.index')}}"  class="nav-link {{ setActiva('usuarios.*') }}">Lista de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a href="{{route('usuarios.create')}}" class="dropdown-item nav-link">Registrar usuario</a> -->
                        <a href="{{route('usuarios.create')}}" class="nav-link {{ setActiva('usuarios.*') }}">Registrar usuario</a>
                    </li>
                  </ul>
                </li>
                @endif

                
                {{-- =============LINKS DE LISTA DE PRECIOS============= --}}
                <li class="nav-item">
                    <a href="{{route('marcas.index')}}" class="nav-link {{ setActiva('marcas.*') }}">
                      Lista de precios
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                    </a>
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
    <main style="min-height: 37em;">
      @if (session()->has('message'))
      <div class="alert alert-warning alert-dismissible" role="alert" id="error">
          <strong>{{ session()->get('message') }}</strong> {{ session('success') }}
      </div>
      @endif
      <div class="container-fluid mb-3">
      </div>
      @yield('contenido')
      @if(session('error'))
      <script>
        document.getElementById('error').scrollIntoView();
        </script>
      @endif
    </main>
@extends('footer')
</body>
</html>
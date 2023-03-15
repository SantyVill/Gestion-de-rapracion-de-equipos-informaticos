@extends('navegacion')

@section('titulo','Lista de clientes')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-7">
                <a href="{{route('clientes.create')}}" class="btn btn-primary {{ setActiva('clientes/create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                    </svg>
                    Registrar Cliente
                </a>
            </div>
            <div class="ps-4 col-5">
                <form class="ps-4 ms-4">
                    <div class="row justify-content-center">
                        <div class="input-group w-50">
                            <input name="buscar" class="form-control" type="search" placeholder="Buscar Cliente" aria-label="Search" value="{{$buscar}}">
                            <span class="input-group-text" id="basic-addon1">
                                    <button style="border:none;" class="p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <h3 class="text-center bg-dark " style="color:rgb(170 170 170">Clientes</h3>
    <div class="row justify-content-center">
        <table class="table w-auto table-responsive table-success table-hover table-striped table-bordered border-2 border-dark shadow rounded">
            <thead>
                <tr class="text-center" style="background-color:black">
                    <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Dirección</th>
                    <th>Correo Electronico</th><th colspan="1">Accion</th>
                </tr>
            </thead>
            @forelse ($clientes as $cliente)
            <tr>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->apellido}}</td>
                <td>{{$cliente->dni}}</td>
                <td>{{$cliente->telefono1}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->mail}}</td>
                <td class=""><a href="{{route('clientes.show',$cliente)}}" class="btn btn-primary">Ver</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="9">No se encontró ningún cliente</td>
            </tr>
            @endforelse
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $clientes->appends($_GET)->links() }}
    </div>     
@endsection
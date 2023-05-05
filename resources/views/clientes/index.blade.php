@extends('navegacion')

@section('titulo','Lista de clientes')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-7">
                <a href="{{route('clientes.create')}}" class="btn btn-sm btn-success border border-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                    </svg>
                    Registrar Cliente
                </a>
            </div>
            <div class="ps-4 col-5">
                <form class="ps-4 ms-4">
                    <div class="row justify-content-center">
                        <div class="input-group w-50">
                            <input name="buscar" class="form-control border-dark p-1" type="search" placeholder="Buscar Cliente" aria-label="Search" value="{{$buscar}}">
                            <span class="input-group-text border-dark p-1 px-2" id="basic-addon1">
                                    <button style="border:none;" class="p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
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
    
    <div class="d-flex justify-content-center">
        <div class="card d-inline-block mx-auto border-dark" style="margin: 0 auto">
            <div class="card-header h4 text-center bg-dark text-light p-1">
                Clientes
            </div>
            <div class="card-body p-0">
                    <table class="table p-0 m-0 w-100 table-responsive table-info table-hover table-striped table-bordered border-2 border-dark shadow rounded">
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
                            <td class="py-1"><a href="{{route('clientes.show',$cliente)}}" class="btn btn-sm btn-primary">Ver</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">No se encontró ningún cliente</td>
                        </tr>
                        @endforelse
                    </table>
            </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{ $clientes->appends($_GET)->links() }}
    </div>     
@endsection
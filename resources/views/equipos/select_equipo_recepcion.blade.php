@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')
<div class="container mb-2">
    <div class="row">
        <div class="col-7">
            <a href="{{route('equipos.create')}}" class="btn btn-success btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                </svg>
                Registrar Equipo
            </a>
        </div>
        <div class="ps-4 col-5">
            <form class="ps-4 ms-4">
                <div class="row justify-content-center">
                    <div class="input-group w-50">
                        <input name="buscar" class="form-control border-dark p-1" type="search" placeholder="Buscar Equipo" aria-label="Search" value="{{$buscar}}">
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
    <div class="card d-inline-block mx-auto border-dark mb-2" style="margin: 0 auto">
        <div class="card-header h4 text-center bg-dark text-light p-1">
            Seleccione un Equipo: 
        </div>
        <div class="card-body p-0">
            <table class="table p-0 m-0 w-100 table-responsive table-info table-hover table-striped table-bordered border-2 border-dark shadow rounded">
                <thead>
                    <tr class="table-primary border-dark {{-- text-center --}}" style="background-color:black">
                        <th scope="col">Numero de Serie</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                @forelse ($equipos as $equipo)
                <tr>
                    <td>{{$equipo->numero_serie}}</td>
                    <td>{{$equipo->caracteristica->tipo->tipo}}</td>
                    <td>{{$equipo->caracteristica->marca->marca}}</td>
                    <td>{{$equipo->caracteristica->modelo}}</td>
                    <td class="py-1"><form method="POST" action="{{route('recepciones.store')}}">
                        @csrf
                        <input class="btn btn-success btn-sm" type="submit" value="Agregar a recepcion">
                        <input type="number" name="equipo_id" value="{{$equipo['id']}}" hidden>
                    </form></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No se registro ningun equipo.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
{{-- </div> --}}
<div class="d-flex justify-content-center">
    {{ $equipos->appends($_GET)->links() }}
</div>
{{-- <div style="background-color:#94bbc8">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Numero de Serie</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th colspan="1" scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td><form method="POST" action="{{route('recepciones.store')}}">
                @csrf
                <input type="submit" value="Agregar a recepcion">
                <input type="number" name="equipo_id" value="{{$equipo['id']}}" hidden>
            </form></td>
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
</div> --}}
@endsection
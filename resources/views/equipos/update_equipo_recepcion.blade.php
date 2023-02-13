@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')

    <div class="container mb-2">
        <div class="row">
            <div class="col-7">
                <a href="{{route('equipos.create')}}" class="btn btn-success {{ setActiva('equipos/create') }}">
                    Registrar Equipo
                </a>
            </div>
            <div class="col-5">
                <form class="form-inlinefloat-right">
                    <div class="row">
                        <div class="col-7">
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Equipo" aria-label="Search" value="{{$buscar}}">
                        </div>
                        <div class="col-2 w-auto m-0 p-0 bg-white rounded">
                            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h3 class="text-center">Lista de Equipos</h3>
    <table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">
        <thead>
            {{-- <tr><th colspan="5" class="text-center"><h4>Lista de Equipos</h4></th></tr> --}}
            <tr>
                <th scope="col">Numero de Serie</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th colspan="2" scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td>
                <form method="POST" action="{{route('recepciones.update',$recepcion)}}">
                    @csrf @method('PATCH')
                    <input type="submit" value="Agregar a recepcion">
                    <input type="number" name="equipo_id" value="{{$equipo['id']}}" hidden>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No se registro ningun equipo.</td>
        </tr>
        @endforelse
    </table>
    <div class="d-flex justify-content-center">
        {{ $equipos->appends($_GET)->links() }}
    </div>
@endsection

@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-6">
                <a href="{{route('recepciones.create')}}" class="btn btn-success {{ setActiva('recepciones/create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                    </svg>
                    Registrar Recepcion
                </a>
            </div>
            <div class="ps-4 col-6">
                <form class="ps-4 ms-4">
                    <div class="row justify-content-center">
                        <div class="input-group w-50">
                            <input name="buscar" class="form-control" type="search" placeholder="Buscar Recepción" aria-label="Search" value="{{$buscar}}">
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
    <h3 class="text-center">Lista de las Recepciones</h3>
    <table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Modelo</th><th>Marca</th><th>Número de Serie</th><th>Fecha Recepción</th>
                <th>Falla:</th>
                @if (auth()->user()->tieneRol(['admin','recepcionista']))
                <th>Cliente</th> 
                @endif 
                <th colspan="2">Accion</th>
            </tr>
       {{-- @endif--}}
        @forelse ($recepciones as $recepcion)
        <tr>
            @if (isset($recepcion->equipo))
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            <td>{{$recepcion->equipo->numero_serie}}</td>
            @else
                <td colspan="3" class="text-center">Equipo Eliminado.</td>
            @endif
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->falla}}</td>

            @if (auth()->user()->tieneRol(['admin','recepcionista']))
            @if (isset($recepcion->cliente))
                <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            @else
                <td class="text-center">Cliente Eliminado.</td>
            @endif
            @endif
            <td class="p-1 text-center col-1"><a href="{{route('recepciones.show',$recepcion)}}" class="btn btn-primary">Ver</a></td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">
                <p>No se registró ninguna recepción</p>
            </td>
        </tr>
        @endforelse
    </table>
    <div class="d-flex justify-content-center">
        {{ $recepciones->appends($_GET)->links() }}
    </div>
@endsection

@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-4">
                <a href="{{route('recepciones.create')}}" class="btn btn-success btn-sm border border-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                    </svg>
                    Registrar Recepcion
                </a>
            </div>
            <div class="ps-4 col-4 ">
                <form class="ps-4 ms-4 d-inline-block">
                    <div class="input-group">
                        <input name="buscar" class="form-control  border border-dark p-1" type="search" placeholder="Buscar por n° Ornden" aria-label="Search" value="">
                        <input type="text" name="NumOrden" value="1" hidden>
                        <span class="input-group-text  border border-dark p-1 px-2" id="basic-addon1">
                                <button style="border:none;" class="p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="ps-4 col-4">
                <form class="ps-4 ms-4 d-inline-block">
                    <div class="justify-content-center">
                        <div class="input-group ">
                            <input name="buscar" class="form-control border border-dark p-1" type="search" placeholder="Busqueda avanzada" aria-label="Search" value="{{$buscar}}">
                            <span class="input-group-text border border-dark p-1 px-2" id="basic-addon1">
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
                Recepciones
            </div>
            <div class="card-body p-0">
                <table class="table p-0 m-0 w-100 table-responsive table-info table-hover table-striped table-bordered border-2 border-dark shadow rounded">
                    <thead>
                        <tr class="text-center"> 
                            <th style="width: 6em;">N° Orden</th>
                            <th>Modelo</th><th>Marca</th><th>Número de Serie</th><th>Fecha Recepción</th>
                            <th>Falla:</th>
                            <th>Cliente</th> 
                            <th>Estado:</th>
                            <th colspan="2">Accion</th>
                        </tr>
                    </thead>
                    @forelse ($recepciones as $recepcion)
                    <tr>
                        <td class="text-center">{{$recepcion->id}}</td>
                        @if (isset($recepcion->equipo))
                        <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
                        <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
                        <td>{{$recepcion->equipo->numero_serie}}</td>
                        @else
                            <td colspan="3" class="text-center">Equipo Eliminado.</td>
                        @endif
                        <td>{{date('d-m-Y',strtotime($recepcion->fecha_recepcion))}}</td>
                        <td>{{$recepcion->falla}}</td>
        
                        {{-- @if (auth()->user()->tieneRol(['admin','recepcionista']))
                        @if (isset($recepcion->cliente)) --}}
                            <td class=""><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
                        {{-- @else
                            <td class="text-center">Cliente Eliminado.</td>
                        @endif
                        @endif --}}
                        <td>{{$recepcion->estado->estado}}</td>
                        <td class="py-1"><a href="{{route('recepciones.show',$recepcion)}}" class="btn btn-sm btn-primary">Ver</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            <p>No se encontró ninguna recepción</p>
                        </td>
                    </tr>
                    @endforelse
                </table>
                <div class="d-flex justify-content-center">
                    {{ $recepciones->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

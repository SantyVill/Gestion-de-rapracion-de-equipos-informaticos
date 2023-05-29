@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-4">
                <a href="{{route('recepciones.create')}}" class="btn btn-success btn-sm border border-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z"/>
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
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{ $recepciones->appends($_GET)->links() }}
    </div>
@endsection

@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <div class="container mb-2">
        <div class="row">
            <div class="col-7">
                <a href="{{route('recepciones.create')}}" class="btn btn-success {{ setActiva('recepciones/create') }}">
                    Registrar Recepcion
                </a>
            </div>
            <div class="col-5">
                <form class="form-inlinefloat-right">
                    <div class="row">
                        <div class="col-7">
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Recepcion" aria-label="Search" value="{{$buscar}}">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
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
            <td><a href="{{route('recepciones.show',$recepcion)}}">Ver</a></td>
        </tr>
        @empty
            <p>No se registró ninguna recepción</p>
        @endforelse
    </table>
    <div class="d-flex justify-content-center">
        {{ $recepciones->appends($_GET)->links() }}
    </div>
@endsection

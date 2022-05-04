@extends('navegacion')

@section('titulo','Lista de recepciones')

@section('contenido')
    <h1>Aqui se mostrara la lista de las recepciones</h1>
    
    <div class="container">
        <div class="row">
            <div class="col-7">
                <a href="{{route('recepciones.create')}}" class="nav-link {{ setActiva('recepciones/create') }}">
                    <button type="button" class="btn btn-success">Registrar Recepcion</button>
                </a>
            </div>
            <div class="col-5">
                <form class="form-inlinefloat-right">
                    <div class="row">
                        <div class="col-7">
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Recepcion" aria-label="Search" value="">
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Modelo</th><th>Marca</th><th>Serie</th><th>Fecha Recepción</th>
                <th>Falla:</th> <th>Cliente</th> <th colspan="2">Accion</th>
            </tr>
       {{-- @endif--}}
        @forelse ($recepciones as $recepcion)
        <tr>
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            <td>{{$recepcion->equipo->numero_serie}}</td>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->falla}}</td>

            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            <td><a href="{{route('recepciones.show',$recepcion)}}">Ver</a></td>
        
            {{-- <td><a href="{{url('recepciones.create', ['equipo_id' => $equipo->id, 'cliente_id' => $cliente->id])}}">Agregar a recepcion</a></td> --}}
        </tr>
        @empty
            <p>No se registró ninguna recepción</p>
        @endforelse
    </table>       
@endsection

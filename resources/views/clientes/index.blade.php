@extends('navegacion')

@section('titulo','Lista de clientes')

@section('contenido')
    <h1>Aqui se mostrara la lista de clientes registrados</h1> 
    
    <div class="container">
        <div class="row">
            <div class="col-8">
                <a href="{{route('clientes.create')}}" class="nav-link {{ setActiva('clientes/create') }}">
                    <button type="button" class="btn btn-success">Registrar Cliente</button>
                </a>
            </div>
            <div class="col-4">
                <form class="form-inlinefloat-right">
                    <div class="row">
                        <div class="col-8">
                            <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Cliente" aria-label="Search" value="">
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
                <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
                <th>Correo Electronico</th><th>Obs:</th><th colspan="1">Accion</th>
            </tr>
       {{-- @endif--}}
        @forelse ($clientes as $cliente)
        <tr>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->apellido}}</td>
            <td>{{$cliente->dni}}</td>
            <td>{{$cliente->telefono1}}</td>
            <td>{{$cliente->telefono2}}</td>
            <td>{{$cliente->direccion}}</td>
            <td>{{$cliente->mail}}</td>
            <td>{{$cliente->observacion}}</td>
            <td><a href="{{route('clientes.show',$cliente)}}">Ver</a></td>
            
            {{-- <td><form method="POST" action="{{route('recepciones.store')}}">
                @csrf
                <input type="submit" value="Agregar a recepcion">
                <input type="number" name="cliente_id" value="{{$cliente['id']}}" hidden>
            </form></td> --}}
            {{-- <a href="{{route('recepciones.create',$equipo)}}">Agregar a recepcion</a> --}}

        {{-- @if(isset($equipo->id))
            <td><a href="{{route('recepciones.create',[$equipo,$cliente])}}">Agregar a recepcion</a></td>
        @endif --}}
            {{-- <td><a href="{{url('recepciones.create', ['equipo_id' => $equipo->id, 'cliente_id' => $cliente->id])}}">Agregar a recepcion</a></td> --}}
        </tr>
        @empty
            <p>No se registró ningún cliente</p>
        @endforelse
    </table>       
@endsection
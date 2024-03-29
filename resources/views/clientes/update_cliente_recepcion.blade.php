@extends('navegacion')

@section('titulo','Cambiar cliente cliente')

@section('contenido')
<div class="container  mb-2">
    <div class="row">
        <div class="col-7">
            <a href="{{route('clientes.create')}}" class="btn btn-success {{ setActiva('clientes/create') }}">
                Registrar Cliente
            </a>
        </div>
        <div class="col-4">
            <form class="form-inlinefloat-right">
                <div class="row">
                    <div class="col-8">
                        <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Cliente" aria-label="Search" value="{{$buscar}}">
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<h3 class="text-center">Lista de clientes</h3> 
<table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">

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
        <td>
            <form method="POST" action="{{route('recepciones.update',$recepcion)}}">
                @csrf @method('PATCH')
                <input type="submit" value="Agregar a recepcion">
                <input type="number" name="cliente_id" value="{{$cliente['id']}}" hidden>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9">No se encontró ningún cliente</td>
    </tr>
    @endforelse
</table>    
<div class="d-flex justify-content-center">
    {{ $clientes->appends($_GET)->links() }}
</div>    
@endsection
@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-7">
            <a href="{{route('marcas.create')}}" class="nav-link}}">
                <button type="button" class="btn btn-success">Registrar Marca</button>
            </a>
        </div>
        <div class="col-5">
            <form class="form-inlinefloat-right">
                <div class="row">
                    <div class="col-7">
                        <input name="buscar" class="form-control mr-sm-2" type="search" placeholder="Buscar Marca" aria-label="Search" value="{{$buscar}}">
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<h3 class="text-center">Lista de Marcas</h3>
<div class=" row justify-content-center">
    <table class="table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded w-auto ">
        <thead>
            <tr>
                <th scope="col" colspan="1">Marca: </th>
                <th scope="col" colspan="3" class="text-center">Acciones: </th>
            </tr>
        </thead>
        @forelse ($marcas as $marca) {{-- Muestro todas las marcas --}}
            <tr>
                <td>{{$marca->marca}}</td>
                @if (auth()->check() && auth()->user()->esAdmin())
                <td><button type="button" class="btn btn-warning">
                    <a class="link-dark" href="{{route('marcas.edit',$marca)}}">Editar</a>
                </button></td>
                @endif
                <td><button type="button" class="btn btn-primary">
                        <a class="link-light" href="{{route('marcas.show',$marca)}}">Ver Modelos</a>
                </button></td>
            
                @if (auth()->check() && auth()->user()->esAdmin())
                <td>
                    <form method="POST" action="{{route('marcas.destroy',$marca)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="4">No se registró ninguna marca.</td>
            </tr>
        @endforelse
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $marcas->appends($_GET)->links() }}
</div>
@endsection
@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
<div class="container mb-2">
    <div class="row">
        <div class="col-7">
            <a href="{{route('marcas.create')}}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                </svg>
                Registrar Marca
            </a>
        </div>
        <div class="ps-4 col-5">
            <form class="ps-4 ms-4">
                <div class="row justify-content-center">
                    <div class="input-group w-50">
                        <input name="buscar" class="form-control" type="search" placeholder="Buscar Marca" aria-label="Search" value="{{$buscar}}">
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
                <td>
                    <a class="" href="{{route('marcas.show',$marca)}}">
                        <button type="button" class="btn btn-info">
                            Ver Modelos
                        </button>
                    </a>
                </td>
                @if (auth()->check() && auth()->user()->esAdmin())
                <td>
                    <a class="" href="{{route('marcas.edit',$marca)}}">
                        <button type="button" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                    </a>
                </td>
                @endif
            
                @if (auth()->check() && auth()->user()->esAdmin())
                <td>
                    <form method="POST" action="{{route('marcas.destroy',$marca)}}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea borrar la marca {{$marca->marca}}?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                            </svg>
                        </button>
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
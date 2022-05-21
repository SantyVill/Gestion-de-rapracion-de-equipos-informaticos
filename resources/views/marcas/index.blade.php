@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')

        @if (count($marcas)==0)
            <p>No se registro ninguna marca.</p>
        @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" colspan="1">Marca: </th>
                    <th scope="col" colspan="3">Acciones: </th>
                </tr>
            </thead>
            @forelse ($marcas as $marca) {{-- Muestro todas las marcas --}}
            <tr>
                <td>{{$marca->marca}}</td>
                <td><button type="button" class="btn btn-warning">
                    <a class="link-dark" href="{{-- {{route('recepciones.edit',$recepcion)}} --}}">Editar</a>
                </button></td>
                <td><button type="button" class="btn btn-primary">
                        <a class="link-light" href="{{route('marcas.show',$marca)}}">Ver Modelos</a>
                </button></td>
            
                <td>
                    <form method="POST" action="{{-- {{route('recepciones.destroy',$recepcion)}} --}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                        <button class="btn btn-danger">Eliminar</button>
                        @csrf @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            @endforelse
        </table>
        @endif
@endsection
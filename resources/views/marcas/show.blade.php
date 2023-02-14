@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
{{-- <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col" colspan="6">
                <div class="row">
                    <div class="col-md-10 text-center">
                        Marca: <b>{{$marca->marca}}</b>
                    </div>
                    <div class="col-md-2 text-end">
                        <a class="text-end" href="{{route('modelos.create',$marca)}}">Agregar nuevo modelo</a>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
        @forelse ($marca->caracteristicas as $caracteristica) 
        <tr>
            <th colspan="6">
                <div class="row">
                    <div class="col-md-10 text-left">
                        Modelo: {{$caracteristica->modelo}} 
                    </div>
                    <div class="col-md-2 text-end">
                        <a class="text-end" href="{{route('precios.create',$caracteristica)}}">Agregar nueva reparacion</a>
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th>Reparacion</th>
            <th>Precio</th>
            <th>Plazo</th>
            <th>Riesgo</th>
            <th colspan="2">Accion</th>
        </tr>
        @forelse ($caracteristica->precios as $precio) 
            <tr>
                <td>{{$precio->reparacion}}</td>
                <td>{{$precio->precio}}</td>
                <td>{{$precio->plazo}}</td>
                <td>{{$precio->riesgo}}</td>
                <td><a href="{{route('precios.edit',$precio)}}" class="btn btn-primary">Editar</a></td>
                <td>
                    <form method="POST" action="{{route('precios.destroy',$precio)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="5"><p>No se registraron precios</p></td>
        @endforelse
    @empty
    <tr>
        <td></td>
    </tr>
    @endforelse
</table> --}}
<table class=" w-auto table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">
    <tr>
        <th>
            <div class="row">
                <div class="col-3">Modelo</div>
                @if (auth()->user()->tieneRol(['admin','recepcionista']))    
                    <div class="col-9 text-end"><a class="btn btn-success" href="{{route('modelos.create',$marca)}}">Agregar modelo</a></div>
                @endif
            </div>
             
        </th>
        <th colspan="4" class="text-center">Acciones</th>
    </tr>
    @forelse ($marca->caracteristicas as $caracteristica)
    <tr>
        <td>{{$caracteristica->modelo}}</td>
        <td>
            <div class="dropend">
                
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Ver Lista de Precios
                </button>
                <div class="dropdown-menu p-1" style="background-color: rgb(196, 231, 255)">
                    <table class="table table-hover table-striped table-bordered bg-white border-2 border-dark rounded m-0">
                        <tr>
                            <th>Reparacion</th>
                            <th>Precio</th>
                            <th>Plazo</th>
                            <th>Riesgo</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                        @forelse ($caracteristica->precios as $precio) {{-- Muestro todos los precios de reparaciones de cada modelo--}}
                        <tr>
                            <td>{{$precio->reparacion}}</td>
                            <td>{{$precio->precio}}</td>
                            <td>{{$precio->plazo}}</td>
                            <td>{{$precio->riesgo}}</td>
                            <td><a href="{{route('precios.edit',$precio)}}" class="btn btn-primary">Editar</a></td>
                            <td>
                                <form method="POST" action="{{route('precios.destroy',$precio)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><p>No se registraron precios</p></td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </td>
        @if (auth()->user()->tieneRol(['admin','recepcionista']))
        <td>
            <a class="btn btn-success" href="{{route('precios.create',$caracteristica)}}">Agregar nueva reparacion</a>
        </td>
        <td>
            <a class="btn btn-primary" href="{{route('modelos.edit',$caracteristica)}}">Editar Modelo</a>
        </td>
        <td>
            <form method="POST" action="{{route('modelos.destroy',$caracteristica)}}"onclick="return confirm('¿Está seguro que desea borrar el Modelo: {{$caracteristica->modelo}}?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Eliminar</button>
            </form>
        </td>
        @endif
    </tr>
    @empty
    <tr>
        <td colspan="2" class="text-center">No se registró ningun modelo para esta marca.</td>
    </tr>
    @endforelse
</table>
@forelse ($marca->caracteristicas as $caracteristica)

@empty
@endforelse
@endsection
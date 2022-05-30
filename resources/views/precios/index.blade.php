@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')

        @if (count($marcas)==0)
            <p>No se registro ninguna marca.</p>
        @else
            @forelse ($marcas as $marca) {{-- Muestro todas las marcas --}}
            <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" colspan="6">
                        <div class="row">
                            <div class="col-md-10 text-left">
                                Marca: <b>{{$marca->marca}}</b>
                            </div>
                            <div class="col-md-2 text-end">
                                <a class="text-end" href="#{{-- {{route('precios.create',$caracteristica)}} --}}">Agregar nuevo modelo</a>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
                @forelse ($marca->caracteristicas as $caracteristica)  {{-- Muesto todos los Modelos de cada marca --}}
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
                @forelse ($caracteristica->precios as $precio) {{-- Muestro todos los precios de reparaciones de cada modelo--}}
                    <tr>
                        <td>{{$precio->reparacion}}</td>
                        <td>{{$precio->precio}}</td>
                        <td>{{$precio->plazo}}</td>
                        <td>{{$precio->riesgo}}</td>
                        @if (auth()->check() && auth()->user()->esAdmin())
                        <td><a href="{{route('precios.edit',$precio)}}" class="btn btn-primary">Editar</a></td>
                        @endif
                        <td>
                            <form method="POST" action="{{route('precios.destroy',$precio)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <td colspan="4"><p>No se restraron precios</p></td>
                    @endforelse
                @empty
                    
                @endforelse
            @empty
            <tr>
                <td></td>
                {{-- <td><a href="{{route('equipos.show',$equipo)}}">Ver</a></td>
                <td><a href="{{route('recepciones.create',$equipo)}}">Agregar a recepcion</a></td> --}}
            </tr>
            </table>
            @endforelse
        @endif
@endsection
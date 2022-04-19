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
                    <th scope="col" colspan="4">Marca: <b>{{$marca->marca}}</b></th>
                </tr>
            </thead>
                @forelse ($marca->caracteristicas as $caracteristica)  {{-- Muesto todos los Modelos de cada marca --}}
                <tr>
                    <th colspan="4">Modelo: {{$caracteristica->modelo}} <a href="{{-- {{route('precios.create',$caracteristica)}} --}}">Agregar nueva reparacion</a></th>
                </tr>
                <tr>
                    <th>Reparacion</th>
                    <th>Precio</th>
                    <th>Plazo</th>
                    <th>Riesgo</th>
                </tr>
                <tr>
                    @forelse ($caracteristica->precios as $precio) {{-- Muestro todos los precios de reparaciones de cada modelo--}}
                        <td>{{$precio->reparacion}}</td>
                        <td>{{$precio->precio}}</td>
                        <td>{{$precio->plazo}}</td>
                        <td>{{$precio->riesgo}}</td>
                    @empty
                        <td colspan="4"><p>No se restraron precios</p></td>
                    @endforelse
                </tr>
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
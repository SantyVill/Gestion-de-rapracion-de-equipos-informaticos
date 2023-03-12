@extends('navegacion')

@section('titulo','Lista de equipos')

@section('contenido')
<div style="background-color:#94bbc8">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Numero de Serie</th>
                <th scope="col">Tipo</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th colspan="1" scope="col">Accion</th>
            </tr>
        </thead>
        @forelse ($equipos as $equipo)
        <tr>
            <td>{{$equipo->numero_serie}}</td>
            <td>{{$equipo->caracteristica->tipo->tipo}}</td>
            <td>{{$equipo->caracteristica->marca->marca}}</td>
            <td>{{$equipo->caracteristica->modelo}}</td>
            <td><form method="POST" action="{{route('recepciones.store')}}">
                @csrf
                <input type="submit" value="Agregar a recepcion">
                <input type="number" name="equipo_id" value="{{$equipo['id']}}" hidden>
                {{-- <a href="{{route('recepciones.create',$equipo)}}">Agregar a recepcion</a> --}}
            </form></td>
        </tr>
        @empty
            <p>No se registro ningun equipo.</p>
        @endforelse
    </table>
</div>
@endsection
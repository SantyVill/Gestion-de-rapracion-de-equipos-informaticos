@extends('navegacion')

@section('titulo','Crear recepciones')

@section('contenido')
    <h1>Aqui se mostrara el formulario para registrar una recepcion</h1>
    @if (isset($equipo->id))
    <p>Equipo Selecionado: </p>
    <ul>
        <li>Numero de serie: {{$equipo->numero_serie}}</li>
        <li>Tipo: {{$equipo->caracteristica->tipo->tipo}}</li>
        <li>Marca: {{$equipo->caracteristica->marca->marca}}</li>
        <li>Modelo: {{$equipo->caracteristica->modelo}}</li>
        <li>Observacion: {{$equipo->observacion}}</li>            
        <li>
            <a href="{{route('recepciones.create')}}">Eliminar equipo</a>
            <a href="{{route('equipos.index')}}">Elegir otro equipo</a>
        </li>
    </ul>
    @if (isset($cliente->id))
    <p>Cliente Selecionado: </p>
    <ul>
        <li>Apellido y Nombre: {{$cliente->Apellido.", ".$cliente->Nombre}}</li>
        <li>DNI: {{$cliente->dni}}</li>
        <li>Mail: {{$cliente->mail}}</li>
        <li>Observacion: {{$cliente->observacion}}</li>            
        <li>
            <a href="{{route('recepciones.create',$equipo)}}">Eliminar cliente</a>
            <a href="{{route('clientes.index',$equipo)}}">Elegir otro cliente</a>
        </li>
    </ul>
    <form method="POST" action="{{-- {{route('recepciones.store')}} --}}">
        @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}


        <input type="text" name="falla" placeholder="Falla" value="{{ old('falla')}}" required><br>
        {!!$errors->first('falla','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
        
        <input type="text" name="accesorios" placeholder="Accesorios" value="{{ old('accesorios')}}" required><br>
        {!!$errors->first('accesorios','<small>:message</small><br>')!!}
        
        <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
    </form>
        
    @else
        <a href="{{route('clientes.index',$equipo)}}">Seleccionar cliente</a>
    @endif
    @else
        <a href="{{route('equipos.index')}}">Seleccionar equipo</a>
    @endif
@endsection
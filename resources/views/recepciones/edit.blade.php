@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
    <h1>Aqui se mostrara el formulario para editar las recepciones</h1>
 {{--    @if (!isset($equipo->id)) 
        <a href="{{route('equipos.index')}}">Seleccionar equipo</a><br>
    @else
        <p>Equipo Selecionado: </p>
        <ul>
            <li>Numero de serie: {{$equipo->numero_serie}}</li>
            <li>Tipo: {{$equipo->caracteristica->tipo->tipo}}</li>
            <li>Marca: {{$equipo->caracteristica->marca->marca}}</li>
            <li>Modelo: {{$equipo->caracteristica->modelo}}</li>
            <li>Observacion: {{$equipo->observacion}}</li>            
            <li>
                <a href="{{route('equipos.index')}}">Elegir otro equipo</a>
            </li>
        </ul>
    @endif
    @if (!isset($cliente->id) && isset($equipo->id))
        <a href="{{route('clientes.index',$equipo)}}">Seleccionar cliente</a>
    @elseif(isset($cliente->id))
        <p>Cliente Selecionado: </p>
        <ul>
            <li>Apellido y Nombre: {{$cliente['apellido'].", ".$cliente->nombre}}</li>
            <li>DNI: {{$cliente->dni}}</li>
            <li>Mail: {{$cliente->mail}}</li>
            <li>Observacion: {{$cliente->observacion}}</li>            
            <li>
                <a href="{{route('clientes.index',$equipo)}}">Elegir otro cliente</a>
            </li>
        </ul>
    @endif --}}
    
    {{-- @if (isset($equipo->id) && isset($cliente->id)) --}}
    <form class="row g-3" method="POST" action="{{route('recepciones.update',$recepcion)}}">
        @csrf @method('PATCH')

        <div class="col-md-6">
            <label for="falla" class="form-label">Falla</label>
            <input type="text" name="falla" placeholder="Falla" value="{{$recepcion->falla}}" required><br>
            {!!$errors->first('falla','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
        </div>
        <div class="col-md-6">
            <label for="accesorio" class="form-label">Accesorio</label>
            <input type="text" name="accesorio" placeholder="Accesorio" value="{{$recepcion->accesorio}}" required><br>
            {!!$errors->first('accesorio','<small>:message</small><br>')!!}
        </div>
        <div class="col-12">
            <label for="observacion" class="form-label">Observacion</label><br>
            <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ $recepcion->observacion}}</textarea><br>
            {!!$errors->first('observacion','<small>:message</small><br>')!!}
        </div>


        {{-- <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br> --}}
        
    
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        <input type="submit" value="Enviar"><br>
    </form>
    {{-- @endif --}}
@endsection
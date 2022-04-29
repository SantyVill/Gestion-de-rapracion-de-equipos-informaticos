@extends('navegacion')

@section('titulo','Crear recepciones')

@section('contenido')
    <h1>Aqui se mostrara el formulario para registrar una recepcion</h1>
    @if (isset($equipo['id'])) {{-- Si el quipo no esta selecionado, muestra el listado para seleccionar uno --}}
        <p>Equipo Selecionado: </p>
        <ul>
            <li>Numero de serie: {{$equipo->numero_serie}}</li>
            <li>Tipo: {{$equipo->caracteristica->tipo->tipo}}</li>
            <li>Marca: {{$equipo->caracteristica->marca->marca}}</li>
            <li>Modelo: {{$equipo->caracteristica->modelo}}</li>
            <li>Observacion: {{$equipo->observacion}}</li>            
            <li>
                {{-- <a href="{{route('recepciones.create')}}">Eliminar equipo</a> --}}
                <a href="{{route('equipos.select_recepcion')}}">Elegir otro equipo</a>
            </li>
        </ul>
    @endif

    @if (isset($cliente->id))
        <p>Cliente Selecionado: </p>
        <ul>
            <li>Apellido y Nombre: {{$cliente['apellido'].", ".$cliente->nombre}}</li>
            <li>DNI: {{$cliente->dni}}</li>
            <li>Mail: {{$cliente->mail}}</li>
            <li>Observacion: {{$cliente->observacion}}</li>            
            <li>
                {{-- <a href="{{route('recepciones.create',$equipo)}}">Eliminar cliente</a> --}}
                <a href="{{route('clientes.select_recepcion')}}">Elegir otro cliente</a>
            </li>
        </ul>
    @endif
    
    {{-- @if (isset($equipo->id) && isset($cliente->id))
    <form method="POST" action="{{route('recepciones.store',[$equipo,$cliente])}}">
        @csrf


        <input type="text" name="falla" placeholder="Falla" value="{{ old('falla')}}" required><br>
        {!!$errors->first('falla','<small>:message</small><br>')!!}
        
        <input type="text" name="accesorio" placeholder="Accesorio" value="{{ old('accesorio')}}" required><br>
        {!!$errors->first('accesorio','<small>:message</small><br>')!!}

        <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br>
        
        <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
    </form>
    @endif --}}
    
    <form method="POST" action="{{route('recepciones.store')}}">
        @csrf

        @if (isset($recepcion))
            
        <input type="text" name="falla" placeholder="Falla" value="{{ old('falla' ,$recepcion['falla'] )}}" required><br>
        {!!$errors->first('falla','<small>:message</small><br>')!!}
        
        <input type="text" name="accesorio" placeholder="Accesorio" value="{{ old('accesorio' ,$recepcion['accesorio'] )}}" required><br>
        {!!$errors->first('accesorio','<small>:message</small><br>')!!}
        
        <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br>
        
        <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion',$recepcion['observacion'] )}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
            
        @else
            
        <input type="text" name="falla" placeholder="Falla" value="{{ old('falla')}}" required><br>
        {!!$errors->first('falla','<small>:message</small><br>')!!}
        
        <input type="text" name="accesorio" placeholder="Accesorio" value="{{ old('accesorio')}}" required><br>
        {!!$errors->first('accesorio','<small>:message</small><br>')!!}
        
        <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br>
        
        <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
            
        @endif
    
        @if (!(null!==(Cookie::get('equipo'))))
            <input type="submit" value="Selecionar Equipo"><br>
        @elseif(!(null!==(Cookie::get('cliente'))))
            <input type="submit" value="Selecionar Cliente"><br>      
        @else
            <input type="submit" value="Confirmar"><br>
        @endif
    </form>
@endsection
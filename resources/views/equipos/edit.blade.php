@extends('navegacion')

@section('titulo','editar titulo')

@section('contenido')
    <h1>Aqui se editara el equipo</h1>
    <form method="POST" action="{{route('equipos.update',$equipo)}}">
        @csrf @method('PATCH')
        <input type="text" name="numero_serie" placeholder="Numero de Serie" value="{{ old('numero_serie',$equipo->numero_serie)}}" required><br>
        {!!$errors->first('num_serie','<small>:message</small><br>')!!}
        
        <input type="text" name="tipo" placeholder="Tipo" value="{{ old('tipo',$equipo->tipo)}}" required><br>
        {!!$errors->first('tipo','<small>:message</small><br>')!!}
        
        <input type="text" name="marca" placeholder="Marca" value="{{ old('marca',$equipo->marca)}}" required><br>
        {!!$errors->first('marca','<small>:message</small><br>')!!}
        
        <input type="text" name="modelo" placeholder="Modelo" value="{{ old('modelo',$equipo->modelo)}}" required><br>
        {!!$errors->first('modelo','<small>:message</small><br>')!!}
        
        <input type="text" name="fallas" placeholder="Fallas" value="{{ old('fallas',$equipo->fallas)}}" required><br>
        {!!$errors->first('fallas','<small>:message</small><br>')!!}
        
        <input type="text" name="accesorios" placeholder="Accesorios" value="{{ old('accesorios',$equipo->accesorios)}}" required><br>
        {!!$errors->first('accesorios','<small>:message</small><br>')!!}
        
        {{-- <input type="text" name="observacion" placeholder="Observacion" value="{{ old('observacion',$equipo->observacion)}}" required><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!} --}}
        
        <textarea name="observacion" placeholder="Observacion" value="prueba" cols="30" rows="10">{{ old('Observacion',$equipo->observacion)}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
    </form>
@endsection
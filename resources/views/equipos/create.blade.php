@extends('navegacion')

@section('titulo','Registrar equipo')

@section('contenido')
<h1>Aqui registra los equipos</h1>
<form method="POST" action="{{route('equipos.store')}}">
    @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
    <input type="text" name="numero_serie" placeholder="Numero de Serie" value="{{ old('numero_serie')}}" required><br>
    {!!$errors->first('num_serie','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
    
    <input type="text" name="tipo" placeholder="Tipo" value="{{ old('tipo')}}" required><br>
    {!!$errors->first('tipo','<small>:message</small><br>')!!}
    
    <input type="text" name="marca" placeholder="Marca" value="{{ old('marca')}}" required><br>
    {!!$errors->first('marca','<small>:message</small><br>')!!}
    
    <input type="text" name="modelo" placeholder="Modelo" value="{{ old('modelo')}}" required><br>
    {!!$errors->first('modelo','<small>:message</small><br>')!!}
    
    <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
    {!!$errors->first('observacion','<small>:message</small><br>')!!}

    <input type="submit" value="Enviar"><br>
</form>
@endsection
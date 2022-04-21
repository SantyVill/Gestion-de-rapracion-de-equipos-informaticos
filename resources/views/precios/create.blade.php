@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
<form method="POST" action="{{route('precios.store',$caracteristica)}}">
    @csrf
    <input type="text" name="reparacion" placeholder="Reparacion" value="{{ old('reparacion')}}" required><br>
    {!!$errors->first('reparacion','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
    
    <input type="number" name="precio" placeholder="Precio" value="{{ old('precio')}}" required><br>
    {!!$errors->first('precio','<small>:message</small><br>')!!}
    
    <input type="date" name="plazo" placeholder="Plazo" value="{{ old('plazo')}}" required><br>
    {!!$errors->first('plazo','<small>:message</small><br>')!!}
    
    <input type="text" name="riesgo" placeholder="Riesgo" value="{{ old('riesgo')}}" required><br>
    {!!$errors->first('riesgo','<small>:message</small><br>')!!}

    <input type="submit" value="Enviar"><br>
</form>
@endsection
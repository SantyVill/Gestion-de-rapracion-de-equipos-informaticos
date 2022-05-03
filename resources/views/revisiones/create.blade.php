@extends('navegacion')

@section('titulo','Registrar revision')

@section('contenido')
<h1>Aqui registra los revisiones</h1>
<form method="POST" action="{{route('revisiones.store',$recepcion)}}">
    @csrf 
    <textarea name="nota" placeholder="Nota" cols="30" rows="10">{{ old('nota')}}</textarea><br>
    {!!$errors->first('nota','<small>:message</small><br>')!!}

    <input type="submit" value="Enviar"><br>
</form>
@endsection
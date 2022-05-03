@extends('navegacion')

@section('titulo','Registrar revision')

@section('contenido')
<h1>Aqui registra los revisiones</h1>
<form method="POST" action="{{route('revisiones.store',$recepcion)}}">
    @csrf 
    <label for="estado">
        Nuevo estado: <input type="text" name="estado" placeholder="Estado" value="{{ old('estado' /* ,$recepcion->estado->estado  */)}}" required>
        {!!$errors->first('estado','<small>:message</small><br>')!!}
    </label><br>
    <label for="nota">Nota:<br>
        <textarea name="nota" placeholder="Nota" cols="30" rows="10">{{ old('nota')}}</textarea>
        {!!$errors->first('nota','<small>:message</small><br>')!!}
    </label>

    <input type="submit" value="Enviar"><br>
</form>
@endsection
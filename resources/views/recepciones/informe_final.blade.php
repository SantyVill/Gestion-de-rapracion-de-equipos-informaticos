@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
    <form method="POST" action="{{route('recepciones.update',$recepcion)}}">
        @csrf @method('PATCH')

        {{-- <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br> --}}
        <label for="informe_final">Informe final: </label><br>
        <textarea name="informe_final" placeholder="Informe Final" cols="30" rows="10">{{ $recepcion->informe_final}}</textarea><br>
        {!!$errors->first('informe_final','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
    </form>
    {{-- @endif --}}
@endsection
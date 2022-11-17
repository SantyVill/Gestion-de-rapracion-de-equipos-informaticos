@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<h1>Aqui registra los clientes</h1>
<form method="POST" action="{{route('clientes.store')}}">
    @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
    <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre')}}" required><br>
    {!!$errors->first('nombre','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
    
    <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido')}}" required><br>
    {!!$errors->first('apellido','<small>:message</small><br>')!!}
    
    <input type="text" name="dni" placeholder="DNI" value="{{ old('dni')}}"><br>
    {!!$errors->first('dni','<small>:message</small><br>')!!}
    
    <input type="text" name="telefono1" placeholder="Telefono1" value="{{ old('telefono1')}}" required><br>
    {!!$errors->first('telefono1','<small>:message</small><br>')!!}
    
    <input type="text" name="telefono2" placeholder="Telefono2" value="{{ old('telefono2')}}"><br>
    {!!$errors->first('telefono2','<small>:message</small><br>')!!}
    
    <input type="text" name="direccion" placeholder="Direccion" value="{{ old('direccion')}}"><br>
    {!!$errors->first('direccion','<small>:message</small><br>')!!}

    <input type="text" name="mail" placeholder="Correo Electronico" value="{{ old('mail')}}" required><br>
    {!!$errors->first('mail','<small>:message</small><br>')!!}
    
    <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
    {!!$errors->first('observacion','<small>:message</small><br>')!!}

    <input type="submit" value="Enviar"><br>
    <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
</form>
@endsection
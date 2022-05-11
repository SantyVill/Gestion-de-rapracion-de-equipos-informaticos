@extends('navegacion')

@section('titulo','Registrar usuario')

@section('contenido')
<h1>Aqui registra los usuarios</h1>
<form method="POST" action="{{route('registros.store')}}">
    @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
    
    <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre')}}" required><br>
    {!!$errors->first('nombre','<small>:message</small><br>')!!}

    <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido')}}" required><br>
    {!!$errors->first('apellido','<small>:message</small><br>')!!}

    <input type="email" name="email" placeholder="Email" value="{{ old('email')}}" required><br>
    {!!$errors->first('email','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
    
    <input type="password" name="password" placeholder="Contraseña" required><br>
    {!!$errors->first('password','<small>:message</small><br>')!!}
    
    <input type="password" name="password_confirmar" placeholder="Confirmar contraseña" required><br>
    {!!$errors->first('password_confirmar','<small>:message</small><br>')!!}

    <label for=""><input type="checkbox" name="tecnico">Técnico</label><br>
    
    <label for=""><input type="checkbox" name="recepcionista">Recepcionista</label><br>

    <input type="submit" value="Enviar"><br>
</form>
@endsection
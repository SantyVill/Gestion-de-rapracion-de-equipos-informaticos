@extends('navegacion')

@section('titulo','Logueo')

@section('contenido')
<h1>Aqui se loguean los usuarios</h1>
<form method="POST" action="{{route('login.store')}}">
    @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
    
    <input type="email" name="email" placeholder="Email" value="{{ old('email')}}" required><br>
    {!!$errors->first('email','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
    
    
    <input type="password" name="password" placeholder="Contraseña" required><br>
    {!!$errors->first('password','<small>:message</small><br>')!!}
    @error('message')
    <p>{{$message}}</p>
    @enderror
    <input type="submit" value="Enviar"><br>
</form>
@endsection
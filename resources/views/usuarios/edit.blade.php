@extends('navegacion')

@section('titulo','Registrar usuario')

@section('contenido')
<h1>Aqui registra los usuarios</h1>
<form method="POST" action="{{route('usuarios.update',$user)}}">
    @csrf @method('PATCH')
    <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre',$user->nombre)}}" required><br>
    {!!$errors->first('nombre','<small>:message</small><br>')!!}

    <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido',$user->apellido)}}" required><br>
    {!!$errors->first('apellido','<small>:message</small><br>')!!}

    <input type="email" name="email" placeholder="Email" value="{{ old('email',$user->email)}}" required><br>
    {!!$errors->first('email','<small>:message</small><br>')!!} 
    
    <input type="password" name="password" placeholder="Contraseña"><br>
    {!!$errors->first('password','<small>:message</small><br>')!!}
    

    <input type="numbre" name="id" value="{{$user->id}}" hidden>

    <label for=""><input type="checkbox" name="tecnico" {{($user->esTecnico())?'checked':''}}>Técnico</label><br>
    
    <label for=""><input type="checkbox" name="recepcionista" {{($user->esRecepcionista())?'checked':''}}>Recepcionista</label><br>

    <input type="submit" value="Enviar"><br>
</form>
@endsection
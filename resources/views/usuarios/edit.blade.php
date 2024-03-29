@extends('navegacion')

@section('titulo','Editar usuario')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('usuarios.update',$user)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend>Editar Usuario</legend>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="nombre" class="form-label">Nombre </label>
                <input type="text" name="nombre" class="form-control border-dark" value="{{ old('nombre',$user->nombre)}}"  {{auth()->user()->tieneRol(['admin'])?'':'disabled'}} maxlength="{{config("tam_nombre")}}">
                {!!$errors->first('nombre','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="apellido" class="form-label">Apellido </label>
                <input type="text" name="apellido" class="form-control border-dark" value="{{ old('apellido',$user->apellido)}}"  {{auth()->user()->tieneRol(['admin'])?'':'disabled'}} maxlength="{{config("tam_apellido")}}">
                {!!$errors->first('apellido','<small>:message</small><br>')!!}<br>
        </div>
        <div class="row mx-auto">
            <div class="col-6">
                <label for="email" class="form-label">Correo Electrónico </label>
                <input type="text" name="email" class="form-control border-dark" value="{{ old('email',$user->email)}}"  {{auth()->user()->tieneRol(['admin'])?'':'disabled'}} maxlength="{{config("tam_mail")}}">
                {!!$errors->first('email','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="password" class="form-label">Nueva Contraseña </label>
                <input type="password" name="password" class="form-control border-dark" maxlength="255">
                {!!$errors->first('password','<small>:message</small><br>')!!}<br>
                
            </div>
        </div>
        <div class="row mb-0 justify-content-center">
            <div class="col-3 pt-4 pb-4">
                <fieldset class="border border-dark " style="background-color: #f2f2f2">
                    <legend class="w-auto px-2">Roles</legend><br>
                        <div class="d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                            <input class="form-check-input" type="checkbox" name="tecnico" {{($user->esTecnico())?'checked':''}} {{auth()->user()->tieneRol(['admin'])?'':'disabled'}}>
                            <label class="form-check-label" for="tecnico">Técnico</label>
                        </div><br>
                        <div class="form-check form-switch d-inline-flex bd-highlight pb-3">
                            <input class="form-check-input" type="checkbox" name="recepcionista" {{($user->esRecepcionista())?'checked':''}} {{auth()->user()->tieneRol(['admin'])?'':'disabled'}}>
                            <label class="form-check-label" for="recepcionista">Recepcionista</label>
                        </div>
                </fieldset>
            </div>
        </div>
        
        <div class="row mb-0 justify-content-center mb-2">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ route('usuarios.show',$user) }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
@endsection
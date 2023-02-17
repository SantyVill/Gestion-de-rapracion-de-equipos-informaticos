@extends('navegacion')

@section('titulo','Editar usuario')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
                
            <form method="POST" action="{{route('usuarios.update',$user)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Editar Usuario</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="nombre" class="form-label">Nombre </label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre',$user->nombre)}}" required><br>
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="apellido" class="form-label">Apellido </label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido',$user->apellido)}}" required><br>
                        {!!$errors->first('apellido','<small>:message</small><br>')!!}
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="email" class="form-label">Correo Electrónico </label>
                        <input type="text" name="email" class="form-control" value="{{ old('email',$user->email)}}" required><br>
                        {!!$errors->first('email','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="password" class="form-label">Nueva Contraseña </label>
                        <input type="password" name="password" class="form-control" ><br>
                        {!!$errors->first('password','<small>:message</small><br>')!!}
                        
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-3 pt-4 pb-4">
                        <fieldset class="border">
                            <legend class="w-auto px-2">Roles</legend><br>
                                <div class="d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                                    <input class="form-check-input" type="checkbox" name="tecnico" {{($user->esTecnico())?'checked':''}}>
                                    <label class="form-check-label" for="tecnico">Técnico</label>
                                </div><br>
                                <div class="form-check form-switch d-inline-flex bd-highlight pb-3">
                                    <input class="form-check-input" type="checkbox" name="recepcionista" {{($user->esRecepcionista())?'checked':''}}>
                                    <label class="form-check-label" for="recepcionista">Recepcionista</label>
                                </div>
                        </fieldset>
                    </div>
                </div>
                
                <div class="row mb-0 justify-content-center">
                    <div class="col-2">
                        <input type="submit" value="Enviar" class="btn btn-success">
                    </div>
                    <div class="col-2">
                        <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</section>




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
    <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
</form>
@endsection
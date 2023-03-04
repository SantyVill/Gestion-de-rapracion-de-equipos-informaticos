@extends('navegacion')

@section('titulo','Registrar usuario')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('usuarios.store')}}" class="align-items-center">
                <legend>Registrar Usuario</legend>
                @csrf 
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="nombre" class="form-label">Nombre </label>
                        <input type="text" name="nombre" class="form-control border-dark" value="{{ old('nombre')}}" required><br>
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="apellido" class="form-label">Apellido </label>
                        <input type="text" name="apellido" class="form-control border-dark" value="{{ old('apellido')}}" required><br>
                        {!!$errors->first('apellido','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6 pt-4 mt-2">
                        <label for="email" class="form-label">Correo Electrónico </label>
                        <input type="text" name="email" class="form-control border-dark" value="{{ old('email')}}" required><br>
                        {!!$errors->first('email','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-3 pt-4 pb-4">
                        <fieldset class="border border-dark" style="background-color: #f2f2f2">
                            <legend class="w-auto px-2">Roles</legend><br>
                                <div class="d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                                    <input class="form-check-input" type="checkbox" name="tecnico">
                                    <label class="form-check-label" for="tecnico">Técnico</label>
                                </div><br>
                                <div class="form-check form-switch d-inline-flex bd-highlight pb-3">
                                    <input class="form-check-input" type="checkbox" name="recepcionista">
                                    <label class="form-check-label" for="recepcionista">Recepcionista</label>
                                </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="password" class="form-label">Contraseña </label>
                        <input type="password" name="password" class="form-control border-dark" required><br>
                        {!!$errors->first('password','<small>:message</small><br>')!!}
                        
                    </div>
                    <div class="col-6">
                        <label for="password_confirm" class="form-label">Confirmar contraseña </label>
                        <input type="password" name="password_confirmar" class="form-control border-dark" required><br>
                        {!!$errors->first('password_confirmar','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                        <input type="submit" value="Registrar" class="btn btn-outline-success">
                    </div>
                    <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                        <a class="btn btn-outline-danger" href="{{ url()->previous() }}" role="button">Cancelar</a>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>


@endsection
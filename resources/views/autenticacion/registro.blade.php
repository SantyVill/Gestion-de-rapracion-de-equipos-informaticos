@extends('navegacion')

@section('titulo','Registrar usuario')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('equipos.store')}}" class="align-items-center">
                <legend>Registrar Usuario</legend>
                @csrf 
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="nombre" class="form-label">Nombre </label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre')}}" required><br>
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="apellido" class="form-label">Apellido </label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido')}}" required><br>
                        {!!$errors->first('apellido','<small>:message</small><br>')!!}
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="password" class="form-label">Contraseña </label>
                        <input type="password" name="password" class="form-control" required><br>
                        {!!$errors->first('password','<small>:message</small><br>')!!}
                        
                    </div>
                    <div class="col-6">
                        <label for="password_confirm" class="form-label">Confirmar contraseña </label>
                        <input type="password" name="password_confirmar" class="form-control" required><br>
                        {!!$errors->first('password_confirmar','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-3 pt-4 pb-4">
                        <fieldset class="border">
                            <legend class="w-auto px-2">Roles</legend><br>
                                {{-- <div class="col-6">
                                    <label for="tecnico"><input type="checkbox" name="tecnico">Técnico</label><br>
                                    <label for="recepcionista"><input type="checkbox" name="recepcionista">Recepcionista</label><br>
                                </div> --}}
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
                    <div class="col-9">
                        <label for="observacion" class="form-label">Observación: </label><br>
                        <textarea name="observacion"  class="form-control" cols="10" rows="4">{{ old('observacion')}}</textarea><br>
                        {!!$errors->first('observacion','<small>:message</small><br>')!!}

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
            
            {{-- <form method="POST" action="{{route('usuarios.store')}}">
                
                <label for=""><input type="checkbox" name="tecnico">Técnico</label><br>
                
                <label for=""><input type="checkbox" name="recepcionista">Recepcionista</label><br>
            
                <input type="submit" value="Enviar"><br>
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form> --}}
        </section>
    </div>
</section>


@endsection
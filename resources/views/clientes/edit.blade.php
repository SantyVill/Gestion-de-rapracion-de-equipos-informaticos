@extends('navegacion')

@section('titulo','Editar Cliente')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('clientes.update',$cliente)}}">
                @csrf @method('PATCH')
                <legend>Editar Cliente</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control border-dark" name="nombre" placeholder="" value="{{ old('nombre',$cliente->nombre)}}" required><br>
                        {!!$errors->first('nombre','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-4">
                        <label for="apellido" class="form-label">Apellido: </label>
                        <input type="text" class="form-control border-dark" name="apellido" placeholder="" value="{{ old('apellido',$cliente->apellido)}}" required><br>
                        {!!$errors->first('apellido','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-4">
                        <label for="dni" class="form-label">DNI: </label>
                        <input type="text" class="form-control border-dark" name="dni" placeholder="" value="{{ old('dni',$cliente->dni)}}"><br>
                        {!!$errors->first('dni','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="telefono1" class="form-label">Telefono: </label>
                        <input type="text" class="form-control border-dark" name="telefono1" placeholder="" value="{{ old('telefono1',$cliente->telefono1)}}" required><br>
                        {!!$errors->first('telefono1','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="telefono2" class="form-label">Telefono 2: </label>
                        <input type="text" class="form-control border-dark" name="telefono2" placeholder="" value="{{ old('telefono2',$cliente->telefono2)}}"><br>
                        {!!$errors->first('telefono2','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" class="form-control border-dark" name="direccion" placeholder="" value="{{ old('direccion',$cliente->direccion)}}"><br>
                        {!!$errors->first('direccion','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="mail" class="form-label">Email: </label>
                        <input type="email"  class="form-control border-dark" name="mail" placeholder="" value="{{ old('mail',$cliente->mail)}}" required><br>
                        {!!$errors->first('mail','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-8">
                        <label for="observacion" class="form-label">Observación: </label><br>
                        <textarea  class="form-control border-dark" name="observacion" placeholder="" cols="30" rows="3">{{ old('observacion',$cliente->observacion)}}</textarea><br>
                        {!!$errors->first('observacion','<small>:message</small><br>')!!}
                    </div>
                </div>
        
                <input type="submit" value="Guardar Cambios" class="btn btn-success">
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</div>
        
        
@endsection
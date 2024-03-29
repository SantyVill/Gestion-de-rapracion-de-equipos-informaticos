@extends('navegacion')

@section('titulo','Editar Cliente')

@section('contenido')

<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('clientes.update',$cliente)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark px-3" style="color:rgb(150 150 150)">Editar Cliente</legend>
        <div class="row mx-auto col-11">
            <div class="col-4">
                <label for="nombre" class="form-label">Nombre: </label>
                <input type="text" class="form-control border-dark" name="nombre" value="{{ old('nombre',$cliente->nombre)}}" maxlength="{{config('tam_nombre')}}">
                {!!$errors->first('nombre','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-4">
                <label for="apellido" class="form-label">Apellido: </label>
                <input type="text" class="form-control border-dark" name="apellido" value="{{ old('apellido',$cliente->apellido)}}" maxlength="{{config('tam_apellido')}}">
                {!!$errors->first('apellido','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-4">
                <label for="dni" class="form-label">DNI: </label>
                <input type="text" class="form-control border-dark" name="dni" value="{{ old('dni',$cliente->dni)}}" maxlength="{{config('tam_dni')}}">
                {!!$errors->first('dni','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="telefono1" class="form-label">Telefono: </label>
                <input type="text" class="form-control border-dark" name="telefono1" value="{{ old('telefono1',$cliente->telefono1)}}" maxlength="{{config('tam_telefono')}}">
                {!!$errors->first('telefono1','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="telefono2" class="form-label">Telefono 2: </label>
                <input type="text" class="form-control border-dark" name="telefono2" value="{{ old('telefono2',$cliente->telefono2)}}" maxlength="{{config('tam_telefono')}}">
                {!!$errors->first('telefono2','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="direccion" class="form-label">Dirección: </label>
                <input type="text" class="form-control border-dark" name="direccion" value="{{ old('direccion',$cliente->direccion)}}" maxlength="{{config('tam_direccion')}}">
                {!!$errors->first('direccion','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="mail" class="form-label">Email: </label>
                <input type="email"  class="form-control border-dark" name="mail" value="{{ old('mail',$cliente->mail)}}" maxlength="{{config('tam_mail')}}">
                {!!$errors->first('mail','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-0 justify-content-center">
            <div class="col-8">
                <label for="observacion" class="form-label">Observación: </label><br>
                <textarea  class="form-control border-dark" name="observacion" cols="30" rows="3">{{ old('observacion',$cliente->observacion)}}</textarea><br>
                {!!$errors->first('observacion','<small>:message</small><br>')!!}
            </div>
        </div>
        
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{route('clientes.show',$cliente)}}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
        
        
@endsection
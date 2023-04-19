@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('clientes.store')}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        <legend class="bg-dark px-3" style="color:rgb(150 150 150)">Registrar cliente</legend>
        @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
        <div class="row mx-auto col-11">
            <div class="col-4">
                <label for="nombre" class="form-label">Nombre: </label>
                <input type="text" class="form-control border-dark" name="nombre" placeholder="" value="{{ old('nombre')}}" required><br>
                {!!$errors->first('nombre','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
            </div>
            <div class="col-4">
                <label for="apellido" class="form-label">Apellido: </label>
                <input type="text" class="form-control border-dark" name="apellido" placeholder="" value="{{ old('apellido')}}" required><br>
                {!!$errors->first('apellido','<small>:message</small><br>')!!}
            </div>
            <div class="col-4">
                <label for="dni" class="form-label">DNI: </label>
                <input type="text" class="form-control border-dark" name="dni" placeholder="" value="{{ old('dni')}}"><br>
                {!!$errors->first('dni','<small>:message</small><br>')!!}
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="telefono1" class="form-label">Telefono: </label>
                <input type="text" class="form-control border-dark" name="telefono1" placeholder="" value="{{ old('telefono1')}}" required><br>
                {!!$errors->first('telefono1','<small>:message</small><br>')!!}
            </div>
            <div class="col-6">
                <label for="telefono2" class="form-label">Telefono 2: </label>
                <input type="text" class="form-control border-dark" name="telefono2" placeholder="" value="{{ old('telefono2')}}"><br>
                {!!$errors->first('telefono2','<small>:message</small><br>')!!}
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="direccion" class="form-label">Dirección: </label>
                <input type="text" class="form-control border-dark" name="direccion" placeholder="" value="{{ old('direccion')}}"><br>
                {!!$errors->first('direccion','<small>:message</small><br>')!!}
            </div>
            <div class="col-6">
                <label for="mail" class="form-label">Email: </label>
                <input type="email"  class="form-control border-dark" name="mail" placeholder="" value="{{ old('mail')}}" required><br>
                {!!$errors->first('mail','<small>:message</small><br>')!!}
            </div>
        </div>
        <div class="row mb-0 justify-content-center">
            <div class="col-8">
                <label for="observacion" class="form-label">Observación: </label><br>
                <textarea  class="form-control border-dark" name="observacion" placeholder="" cols="30" rows="3">{{ old('observacion')}}</textarea><br>
                {!!$errors->first('observacion','<small>:message</small><br>')!!}
            </div>
        </div>
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ url()->previous() }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>

@endsection


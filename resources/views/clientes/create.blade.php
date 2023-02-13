@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
{{-- <div class="row justify-content-center">
    <div class="col-10">
        <h2 class="align-items-center">Registro de clientes</h2>
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('clientes.store')}}" class="align-items-center">
                @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
                
                {{--

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" name="nombre" placeholder="name@example.com" value="{{ old('nombre')}}" required><br>
                    {!!$errors->first('nombre','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
                
                {{--
                
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido: </label>
                    <input type="text" class="form-control" name="apellido" placeholder="" value="{{ old('apellido')}}" required><br>
                    {!!$errors->first('apellido','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI: </label>
                    <input type="text" class="form-control" name="dni" placeholder="" value="{{ old('dni')}}"><br>
                    {!!$errors->first('dni','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="telefono1" class="form-label">Telefono: </label>
                    <input type="text" class="form-control" name="telefono1" placeholder="" value="{{ old('telefono1')}}" required><br>
                    {!!$errors->first('telefono1','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="telefono2" class="form-label">Telefono 2: </label>
                    <input type="text" class="form-control" name="telefono2" placeholder="" value="{{ old('telefono2')}}"><br>
                    {!!$errors->first('telefono2','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección: </label>
                    <input type="text" class="form-control" name="direccion" placeholder="" value="{{ old('direccion')}}"><br>
                    {!!$errors->first('direccion','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Email: </label>
                    <input type="text" name="mail" placeholder="" value="{{ old('mail')}}" required><br>
                    {!!$errors->first('mail','<small>:message</small><br>')!!}
                </div>
                <div class="mb-3">
                    <label for="observacion" class="form-label">Observación: </label><br>
                    <textarea name="observacion" placeholder="" cols="30" rows="10">{{ old('observacion')}}</textarea><br>
                    {!!$errors->first('observacion','<small>:message</small><br>')!!}
                </div>
        
                <input type="submit" value="Enviar"><br>
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</div> --}}






<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('clientes.store')}}" class="align-items-center">
                <legend>Registrar cliente</legend>
                @csrf {{-- token de seguridad https://www.youtube.com/watch?v=bNgV5hZ2Uco&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=17 --}}
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="nombre" placeholder="" value="{{ old('nombre')}}" required><br>
                        {!!$errors->first('nombre','<small>:message</small><br>')!!} {{-- Error de validacion: https://www.youtube.com/watch?v=N_G52bdrQtI&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=18 --}}
                    </div>
                    <div class="col-4">
                        <label for="apellido" class="form-label">Apellido: </label>
                        <input type="text" class="form-control" name="apellido" placeholder="" value="{{ old('apellido')}}" required><br>
                        {!!$errors->first('apellido','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-4">
                        <label for="dni" class="form-label">DNI: </label>
                        <input type="text" class="form-control" name="dni" placeholder="" value="{{ old('dni')}}"><br>
                        {!!$errors->first('dni','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="telefono1" class="form-label">Telefono: </label>
                        <input type="text" class="form-control" name="telefono1" placeholder="" value="{{ old('telefono1')}}" required><br>
                        {!!$errors->first('telefono1','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="telefono2" class="form-label">Telefono 2: </label>
                        <input type="text" class="form-control" name="telefono2" placeholder="" value="{{ old('telefono2')}}"><br>
                        {!!$errors->first('telefono2','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="direccion" class="form-label">Dirección: </label>
                        <input type="text" class="form-control" name="direccion" placeholder="" value="{{ old('direccion')}}"><br>
                        {!!$errors->first('direccion','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="mail" class="form-label">Email: </label>
                        <input type="email"  class="form-control" name="mail" placeholder="" value="{{ old('mail')}}" required><br>
                        {!!$errors->first('mail','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-8">
                        <label for="observacion" class="form-label">Observación: </label><br>
                        <textarea  class="form-control" name="observacion" placeholder="" cols="30" rows="3">{{ old('observacion')}}</textarea><br>
                        {!!$errors->first('observacion','<small>:message</small><br>')!!}
                    </div>
                </div>
        
                <input type="submit" value="Enviar" class="btn btn-success">
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</section>

@endsection


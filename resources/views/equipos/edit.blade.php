@extends('navegacion')

@section('titulo','Editar Equipo')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('equipos.update',$equipo)}}">
                @csrf @method('PATCH')
                <legend>Editar Equipo</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="numero_serie" class="form-label">Numero de Serie: </label>
                        <input type="text" class="form-control border-dark" name="numero_serie" value="{{ old('numero_serie',$equipo->numero_serie)}}" required><br>
                        {!!$errors->first('num_serie','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="tipo" class="form-label">Tipo: </label>
                        <input type="text" class="form-control border-dark" name="tipo" value="{{ old('tipo',$equipo->caracteristica->tipo->tipo)}}" required><br>
                        {!!$errors->first('tipo','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="modelo" class="form-label">Modelo: </label>
                        <input type="text"  class="form-control border-dark" name="modelo" value="{{ old('modelo',$equipo->caracteristica->modelo)}}" required><br>
                        {!!$errors->first('modelo','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="marca" class="form-label">Marca: </label>
                        <input type="text" class="form-control border-dark" name="marca" value="{{ old('marca',$equipo->caracteristica->marca->marca)}}" required><br>
                        {!!$errors->first('marca','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-8">
                        <label for="observacion" class="form-label">Observación: </label><br>
                        <textarea name="observacion"  class="form-control border-dark" cols="10" rows="4">{{ old('observacion',$equipo->observacion)}}</textarea><br>
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
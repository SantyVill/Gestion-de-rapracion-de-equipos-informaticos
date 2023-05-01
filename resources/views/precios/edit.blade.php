@extends('navegacion')

@section('titulo','Editar Precio')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('precios.update',$precio)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Registrar Precio de Reparación</legend>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="reparacion" class="form-label">Reparación </label>
                <input type="text" name="reparacion" class="form-control border-dark" value="{{ old('reparacion',$precio->reparacion)}}">
                {!!$errors->first('reparacion','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="precio" class="form-label">Precio </label>
                <input type="number" name="precio" class="form-control border-dark" value="{{ old('precio',$precio->precio)}}">
                {!!$errors->first('precio','<small>:message</small><br>')!!}<br>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="plazo" class="form-label">Plazo para terminar reparación</label>
                <input type="number" name="plazo" class="form-control border-dark" value="{{ old('plazo',$precio->plazo)}}">
                {!!$errors->first('plazo','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="riesgo" class="form-label">Riesgo </label>
                <input type="text" name="riesgo" class="form-control border-dark" value="{{ old('riesgo',$precio->riesgo)}}">
                {!!$errors->first('riesgo','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ route('marcas.show',$precio->caracteristica->marca) }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
@endsection
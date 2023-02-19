@extends('navegacion')

@section('titulo','Editar Precio')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('precios.update',$precio)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Registrar Precio de Reparación</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="reparacion" class="form-label">Reparación </label>
                        <input type="text" name="reparacion" class="form-control border-dark" value="{{ old('reparacion',$precio->reparacion)}}" required><br>
                        {!!$errors->first('reparacion','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="precio" class="form-label">Precio </label>
                        <input type="number" name="precio" class="form-control border-dark" value="{{ old('precio',$precio->precio)}}" required><br>
                        {!!$errors->first('precio','<small>:message</small><br>')!!}
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="plazo" class="form-label">Plazo </label>
                        <input type="date" name="plazo" class="form-control border-dark" value="{{ old('plazo',$precio->plazo)}}" required><br>
                        {!!$errors->first('plazo','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="riesgo" class="form-label">Riesgo </label>
                        <input type="text" name="riesgo" class="form-control border-dark" value="{{ old('riesgo',$precio->riesgo)}}" required><br>
                        {!!$errors->first('riesgo','<small>:message</small><br>')!!}
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
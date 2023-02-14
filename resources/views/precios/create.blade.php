@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('precios.store',$caracteristica)}}" class="align-items-center">
                @csrf
                <legend>Registrar Precio de Reparación</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="reparacion" class="form-label">Reparación </label>
                        <input type="text" name="reparacion" class="form-control" value="{{ old('reparacion')}}" required><br>
                        {!!$errors->first('reparacion','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="precio" class="form-label">Precio </label>
                        <input type="number" name="precio" class="form-control" value="{{ old('precio')}}" required><br>
                        {!!$errors->first('precio','<small>:message</small><br>')!!}
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="plazo" class="form-label">Plazo </label>
                        <input type="date" name="plazo" class="form-control" value="{{ old('plazo')}}" required><br>
                        {!!$errors->first('plazo','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="riesgo" class="form-label">Riesgo </label>
                        <input type="text" name="riesgo" class="form-control" value="{{ old('riesgo')}}" required><br>
                        {!!$errors->first('riesgo','<small>:message</small><br>')!!}
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
@endsection
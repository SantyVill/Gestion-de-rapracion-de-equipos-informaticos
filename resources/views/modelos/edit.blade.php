@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('modelos.update',$caracteristica)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Editar Modelo</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="modelo" class="form-label">Modelo: </label>
                        <input type="text" class="form-control" name="modelo" placeholder="" value="{{ old('modelo',$caracteristica->modelo)}}" required><br>
                        {!!$errors->first('modelo','<small>:message</small><br>')!!} 
                    </div>
                    <div class="col-4">
                        <label for="tipo" class="form-label">Tipo: </label>
                        <input type="text" class="form-control" name="tipo" placeholder="" value="{{ old('tipo',$caracteristica->tipo->tipo)}}" required><br>
                        {!!$errors->first('tipo','<small>:message</small><br>')!!} 
                    </div>
                </div>
                <input type="submit" value="Enviar" class="btn btn-success">
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</section>
@endsection
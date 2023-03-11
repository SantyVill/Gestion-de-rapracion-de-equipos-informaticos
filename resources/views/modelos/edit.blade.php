@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('modelos.update',$caracteristica)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Editar Modelo</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="modelo" class="form-label">Modelo: </label>
                        <input type="text" class="form-control border-dark" name="modelo" placeholder="" value="{{ old('modelo',$caracteristica->modelo)}}" required><br>
                        {!!$errors->first('modelo','<small>:message</small><br>')!!} 
                    </div>
                    <div class="col-4">
                        <label for="tipo" class="form-label">Tipo: </label>
                        <input type="text" class="form-control border-dark" name="tipo" placeholder="" value="{{ old('tipo',$caracteristica->tipo->tipo)}}" required><br>
                        {!!$errors->first('tipo','<small>:message</small><br>')!!} 
                    </div>
                    <input type="number" name="marca_id" value="{{$caracteristica->marca->id}}" hidden>
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
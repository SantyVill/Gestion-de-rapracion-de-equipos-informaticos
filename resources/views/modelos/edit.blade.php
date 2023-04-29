@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')

<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('modelos.update',$caracteristica)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Editar Modelo</legend>
        <div class="row mb-0 justify-content-center">
            <div class="col-4">
                <label for="modelo" class="form-label">Modelo: </label>
                <input type="text" class="form-control border-dark" name="modelo" placeholder="" value="{{ old('modelo',$caracteristica->modelo)}}" required maxlength="{{config("tam_modelo")}}">
                {!!$errors->first('modelo','<small>:message</small><br>')!!} <br>
            </div>
            <div class="col-4">
                <label for="tipo" class="form-label">Tipo: </label>
                <input type="text" class="form-control border-dark" name="tipo" placeholder="" value="{{ old('tipo',$caracteristica->tipo->tipo)}}" required maxlength="{{config("tam_tipo")}}">
                {!!$errors->first('tipo','<small>:message</small><br>')!!} <br>
            </div>
            <input type="number" name="marca_id" value="{{$caracteristica->marca->id}}" hidden>
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
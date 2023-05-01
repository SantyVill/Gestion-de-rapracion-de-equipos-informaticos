@extends('navegacion')

@section('titulo','Editar marca')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('marcas.update',$marca)}}" class="col-5 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Editar Marca</legend>
        <div class="row mb-0 justify-content-center">
            <div class="col-6">
                <label for="marca" class="form-label">Marca: </label>
                <input type="text" class="form-control border-dark" name="marca" placeholder="" value="{{ old('marca',$marca->marca)}}" maxlength="{{config("tam_marca")}}">
                {!!$errors->first('marca','<small>:message</small><br>')!!} <br>
            </div>
            <input type="text" name='marca_id' value="{{$marca['id']}}" hidden>
        </div>
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{route('marcas.show',$marca)}}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
@endsection


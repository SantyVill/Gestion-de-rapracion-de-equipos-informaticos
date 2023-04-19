@extends('navegacion')

@section('titulo','Agregar Modelo')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('modelos.store',$marca)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        <legend class="bg-dark" style="color:rgb(150 150 150)">Agregar Modelo</legend>
        @csrf 
        <div class="row mx-auto col-11">
            <div class="col-4">
                <fieldset disabled>
                    <label for="marca" class="form-label">Marca </label>
                    <input type="text" class="form-control border-dark" name="marca" placeholder="" value="{{ old('marca',$marca['marca'])}}" required><br>
                    {!!$errors->first('marca','<small>:message</small><br>')!!} 
                </fieldset>
            </div>
            <div class="col-4">
                <label for="modelo" class="form-label">Modelo </label>
                <input type="text" class="form-control border-dark" name="modelo" placeholder="" value="{{ old('modelo')}}"><br>
                {!!$errors->first('modelo','<small>:message</small><br>')!!}
            </div>
            <div class="col-4">
                <label for="tipo" class="form-label">Tipo </label>
                <input type="text" class="form-control border-dark" name="tipo" placeholder="" value="{{ old('tipo')}}"><br>
                {!!$errors->first('tipo','<small>:message</small><br>')!!}
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


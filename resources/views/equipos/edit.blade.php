@extends('navegacion')

@section('titulo','Editar Equipo')

@section('contenido')

<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('equipos.update',$equipo)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Editar Equipo</legend>
        <legend></legend>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="numero_serie" class="form-label">Numero de Serie: </label>
                <input type="text" class="form-control border-dark" name="numero_serie" value="{{ old('numero_serie',$equipo->numero_serie)}}" required maxlength="{{config('tam_numSerie')}}"><br>
                {!!$errors->first('num_serie','<small>:message</small><br>')!!}
            </div>
            <div class="col-6">
                <label for="tipo" class="form-label">Tipo: </label>
                <input type="text" class="form-control border-dark" name="tipo" value="{{ old('tipo',$equipo->caracteristica->tipo->tipo)}}" required maxlength="{{config('tam_tipo')}}"><br>
                {!!$errors->first('tipo','<small>:message</small><br>')!!}
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="modelo" class="form-label">Modelo: </label>
                <input type="text"  class="form-control border-dark" name="modelo" value="{{ old('modelo',$equipo->caracteristica->modelo)}}" required maxlength="{{config('tam_modelo')}}"><br>
                {!!$errors->first('modelo','<small>:message</small><br>')!!}
            </div>
            <div class="col-6">
                <label for="marca" class="form-label">Marca: </label>
                <input type="text" class="form-control border-dark" name="marca" value="{{ old('marca',$equipo->caracteristica->marca->marca)}}" required maxlength="{{config('tam_marca')}}"><br>
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

        <div class="row mb-0 justify-content-center mb-2">
            <div class="col-4 me-4 w-auto p-1 rounded border border-dark" style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded border border-dark" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ url()->previous() }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</section>
@endsection
@extends('navegacion')

@section('titulo','Registrar equipo')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('equipos.store')}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        <legend class="bg-dark" style="color:rgb(150 150 150)">Registrar Equipo</legend>
        @csrf 
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="numero_serie" class="form-label">Numero de Serie: </label>
                <input type="text" class="form-control border-dark" name="numero_serie" value="{{ old('numero_serie')}}" maxlength="{{config('tam_numSerie')}}">
                {!!$errors->first('numero_serie','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="tipo" class="form-label">Tipo: </label>
                <input type="text" class="form-control border-dark" name="tipo" value="{{ old('tipo')}}" maxlength="{{config('tam_tipo')}}">
                {!!$errors->first('tipo','<small>:message</small><br>')!!}<br>
                
            </div>
        </div>
        <div class="row mx-auto col-11">
            <div class="col-6">
                <label for="modelo" class="form-label">Modelo: </label>
                <input type="text"  class="form-control border-dark" name="modelo" value="{{ old('modelo')}}" maxlength="{{config('tam_modelo')}}">
                {!!$errors->first('modelo','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-6">
                <label for="marca" class="form-label">Marca: </label>
                <input type="text" class="form-control border-dark" name="marca" value="{{ old('marca')}}" maxlength="{{config('tam_marca')}}">
                {!!$errors->first('marca','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-0 justify-content-center">
            <div class="col-8">
                <label for="observacion" class="form-label">Observación: </label><br>
                <textarea name="observacion"  class="form-control border-dark" cols="10" rows="4">{{ old('observacion')}}</textarea>
                {!!$errors->first('observacion','<small>:message</small><br>')!!}<br>

            </div>
        </div>
        <div class="row mb-0 justify-content-center mb-2">
            {{-- <div class="col-4 me-4 w-auto p-1 rounded border border-dark" style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded border border-dark" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ url()->previous() }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                    Cancelar
                </a>
            </div> --}}
            <div class="col-1">
                <button type="submit" class="p-1 w-auto rounded border border-dark text-success rounded-circle" style="background-color: rgb(232, 240, 247)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </button>
            </div>
            <div class="col-1 {{-- ms-4 w-auto p-1 rounded border border-dark --}}" {{-- style="background-color: rgb(232, 240, 247)" --}}>
                <button type="button" class="p-1 w-auto rounded border border-dark text-danger rounded-circle" style="background-color: rgb(232, 240, 247)">
                    <a class="text-danger" href="{{ route('equipos.index') }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </a>
                </button>
            </div>
        </div>
    </form>
</section>

@endsection






{{-- @extends('navegacion')

@section('titulo','Registrar equipo')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class=" row border border-secondary border-2 rounded-3 col-8 justify-content-center" style="background-color: #41aa42">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('equipos.store')}}" class=" align-items-center">
                <legend>Registrar Equipo</legend>
                @csrf 
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="numero_serie" class="form-label">Numero de Serie: </label>
                        <input type="text" class="form-control" name="numero_serie" value="{{ old('numero_serie')}}"><br>
                        {!!$errors->first('num_serie','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="tipo" class="form-label">Tipo: </label>
                        <input type="text" class="form-control" name="tipo" value="{{ old('tipo')}}"><br>
                        {!!$errors->first('tipo','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-6">
                        <label for="modelo" class="form-label">Modelo: </label>
                        <input type="text"  class="form-control" name="modelo" value="{{ old('modelo')}}"><br>
                        {!!$errors->first('modelo','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-6">
                        <label for="marca" class="form-label">Marca: </label>
                        <input type="text" class="form-control" name="marca" value="{{ old('marca')}}"><br>
                        {!!$errors->first('marca','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-0 justify-content-center">
                    <div class="col-8">
                        <label for="observacion" class="form-label">Observación: </label><br>
                        <textarea name="observacion"  class="form-control" cols="10" rows="4">{{ old('observacion')}}</textarea><br>
                        {!!$errors->first('observacion','<small>:message</small><br>')!!}

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
</section>

@endsection --}}
@extends('navegacion')

@section('titulo','Registrar revision')

@section('contenido')


<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('revisiones.store',$recepcion)}}" class="align-items-center">
                @csrf
                <legend>Agregar revisión</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="estado" class="form-label">Nuevo Estado: </label>
                        <input type="text" name="estado" class="form-control" value="{{ old('estado',$recepcion->estado->estado )}}" required>
                        {!!$errors->first('estado','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-8">
                        <label for="nota" class="form-label">Nota: </label><br>
                        <textarea  class="form-control" name="nota" placeholder="" cols="30" rows="3" required>{{ old('nota')}}</textarea><br>
                        {!!$errors->first('nota','<small>:message</small><br>')!!}
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

@endsection
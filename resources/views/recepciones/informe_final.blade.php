@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('recepciones.update',$recepcion)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Agregar revisión</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-8">
                        <label for="informe_final" class="form-label">Informe_Final: </label><br>
                        <textarea  class="form-control" name="informe_final" placeholder="" cols="30" rows="3" required>{{ old('informe_final',$recepcion->informe_final)}}</textarea><br>
                        {!!$errors->first('informe_final','<small>:message</small><br>')!!}
                    </div>
                </div>
                <input type="submit" value="Enviar" class="btn btn-success">
                <a class="btn btn-danger" href="{{ route('recepciones.show',$recepcion) }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</section>
@endsection
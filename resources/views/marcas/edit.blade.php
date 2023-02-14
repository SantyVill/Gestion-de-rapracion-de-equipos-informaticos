@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<section class="pb-4 row justify-content-center">
    <div class="bg-white row border border-secondary border-2 rounded-3 col-8 justify-content-center">
    
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('marcas.update',$marca)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Registrar Marca</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="marca" class="form-label">Marca: </label>
                        <input type="text" class="form-control" name="marca" placeholder="" value="{{ old('marca',$marca->marca)}}" required><br>
                        {!!$errors->first('marca','<small>:message</small><br>')!!} 
                    </div>
                    <input type="text" name='marca_id' value="{{$marca['id']}}" hidden>
                </div>
                <input type="submit" value="Enviar" class="btn btn-success">
                <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</section>
@endsection


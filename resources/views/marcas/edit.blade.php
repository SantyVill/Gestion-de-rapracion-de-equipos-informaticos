@extends('navegacion')

@section('titulo','Editar marca')

@section('contenido')
<div class="row justify-content-center">
        <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('marcas.update',$marca)}}" class="align-items-center">
                @csrf @method('PATCH')
                <legend>Editar Marca</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="marca" class="form-label">Marca: </label>
                        <input type="text" class="form-control border-dark" name="marca" placeholder="" value="{{ old('marca',$marca->marca)}}" required><br>
                        {!!$errors->first('marca','<small>:message</small><br>')!!} 
                    </div>
                    <input type="text" name='marca_id' value="{{$marca['id']}}" hidden>
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


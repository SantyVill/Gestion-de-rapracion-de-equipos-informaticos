@extends('navegacion')

@section('titulo','Registrar cliente')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #94bbc8">
        <section class="w-100 p-4 text-center pb-4">
            <form method="POST" action="{{route('marcas.store')}}" class="align-items-center">
                <legend class="bg-dark" style="color:rgb(150 150 150)">Registrar Marca</legend>
                @csrf 
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="marca" class="form-label">Marca: </label>
                        <input type="text" class="form-control border-dark" name="marca" placeholder="" value="{{ old('marca')}}" required><br>
                        {!!$errors->first('marca','<small>:message</small><br>')!!} 
                    </div>
                    <div class="col-4">
                        <label for="modelo" class="form-label">Modelo: </label>
                        <input type="text" class="form-control border-dark" name="modelo" placeholder="" value="{{ old('modelo')}}"><br>
                        {!!$errors->first('modelo','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-4">
                        <label for="tipo" class="form-label">Tipo: </label>
                        <input type="text" class="form-control border-dark" name="tipo" placeholder="" value="{{ old('tipo')}}"><br>
                        {!!$errors->first('tipo','<small>:message</small><br>')!!}
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
</div>
@endsection


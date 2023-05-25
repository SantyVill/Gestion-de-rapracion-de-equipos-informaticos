@extends('navegacion')

@section('titulo','Agregar Nota')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('revisiones.store',$recepcion)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center" >
        @csrf
        <legend class="bg-dark" style="color:rgb(150 150 150)">Agregar nota</legend>
        <div class="row mx-auto col-11">
            <div class="col-4">
                <label for="accesorio" class="form-label">Estado: </label>
                <select class="form-select border-dark" id="estado" name="estado" aria-label="Default select example">
                    <option value="{{$recepcion->estado->estado}}" selected>{{$recepcion->estado->estado}}</option>
                @foreach ($posiblesEstados as $estadoPosible)
                    @if (auth()->user()->tieneRol(['admin','recepcionista'])&&in_array($estadoPosible,['A Presupuestar','Presupuesto Aceptado','Equipo Entregado']))
                    <option value="{{$estadoPosible}}" >{{$estadoPosible}}</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','tecnico'])&&in_array($estadoPosible,['En Revisión','Presupuesto Realizado','En Reparación','Reparación Terminada']))
                    <option value="{{$estadoPosible}}">{{$estadoPosible}}</option>
                    @endif
                    @endforeach
                </select>
                <div class="mt-3 d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                    <input class="form-check-input" id="nota-interna" type="checkbox" name="interna">
                    <label class="form-check-label" for="tecnico">Nota Interna</label>
                </div>
            </div>
            <div class="col-8">
                <label for="nota" class="form-label">Nota: </label><br>
                <textarea  class="form-control border-dark" name="nota" placeholder="" cols="30" rows="3">{{ old('nota')}}</textarea>
                {!!$errors->first('nota','<small>:message Puedes seleccionar otro estado.</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ route('recepciones.show',$recepcion) }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
    <script>
        let estadoAnterior = document.getElementById('estado').value;
        document.getElementById('nota-interna').addEventListener('change', function() {
            let estadoSelect = document.getElementById('estado');
            if (this.checked) {
                estadoAnterior = estadoSelect.value;
                estadoSelect.disabled = true;
                estadoSelect.value = '';
            } else {
                estadoSelect.disabled = false;
                estadoSelect.value = estadoAnterior;
            }
        });
    </script>         
</section>

@endsection
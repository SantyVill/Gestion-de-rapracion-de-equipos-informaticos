@extends('navegacion')

@section('titulo','Editar Nota')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('revisiones.update',$revision)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Editar nota</legend>
        <div class="row mb-0 justify-content-center">
            <div class="col-4">
                {{-- <label for="accesorio" class="form-label">Estado: </label>
                <select class="form-select border-dark" name="estado" aria-label="Default select example">
                    <option value="">Elegir Nuevo Estado</option>
                    @if (auth()->user()->tieneRol(['admin','recepcionista']))
                    <option value="A presupuestar" {{$recepcion->estado->opSelected("A presupuestar")}}>A presupuestar</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','tecnico']))
                    <option value="En Revisión" {{$recepcion->estado->opSelected("En Revisión")}}>En Revisión</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','tecnico']))
                    <option value="Presupuesto Realizado" {{$recepcion->estado->opSelected("Presupuesto Realizado")}}>Presupuesto Realizado</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','recepcionista']))
                    <option value="Presupuesto Aceptado" {{$recepcion->estado->opSelected("Presupuesto Aceptado")}}>Presupuesto Aceptado</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','tecnico']))
                    <option value="En Reparación" {{$recepcion->estado->opSelected("En Reparación")}}>En Reparación</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','tecnico']))
                    <option value="Reparación Terminada" {{$recepcion->estado->opSelected("Reparación Terminada")}}>Reparación Terminada</option>
                    @endif
                    @if (auth()->user()->tieneRol(['admin','recepcionista']))
                    <option value="Equipo Entregado" {{$recepcion->estado->opSelected("Equipo Entregado")}}>Equipo Entregado</option>
                    @endif
                </select> --}}
                <div class="mt-3 d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                    <input class="form-check-input" type="checkbox" name="interna" {{$revision->interna?'checked':''}}>
                    <label class="form-check-label" for="tecnico">Nota Interna</label>
                </div>
            </div>
            <div class="col-8">
                <label for="nota" class="form-label">Nota: </label><br>
                <textarea  class="form-control border-dark" name="nota" placeholder="" cols="30" rows="3">{{ old('nota',$revision->nota)}}</textarea>
                {!!$errors->first('nota','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-2 justify-content-center">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ route('recepciones.show',$revision->recepcion) }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
@endsection
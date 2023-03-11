@extends('navegacion')

@section('titulo','Registrar revision')

@section('contenido')


<div class="row justify-content-center">
    <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
        <section class="w-100 p-3 text-center pb-4">
            <form method="POST" action="{{route('revisiones.store',$recepcion)}}" class="align-items-center" >
                @csrf
                <legend>Agregar nota</legend>
                <div class="row mb-0 justify-content-center">
                    <div class="col-4">
                        <label for="accesorio" class="form-label">Estado: </label>
                        <select class="form-select border-dark" name="estado" aria-label="Default select example">
                            @if (auth()->user()->tieneRol(['admin','recepcionista'])||strcmp($recepcion->estado->estado,'A presupuestar')==0)
                            <option value="A presupuestar" {{$recepcion->estado->opSelected("A presupuestar")}}>A presupuestar</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','tecnico'])||strcmp($recepcion->estado->estado,'En Revisión')==0)
                            <option value="En Revisión" {{$recepcion->estado->opSelected("En Revisión")}}>En Revisión</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','tecnico'])||strcmp($recepcion->estado->estado,'Presupuesto Realizado')==0)
                            <option value="Presupuesto Realizado" {{$recepcion->estado->opSelected("Presupuesto Realizado")}}>Presupuesto Realizado</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','recepcionista'])||strcmp($recepcion->estado->estado,'Presupuesto Aceptado')==0)
                            <option value="Presupuesto Aceptado" {{$recepcion->estado->opSelected("Presupuesto Aceptado")}}>Presupuesto Aceptado</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','tecnico'])||strcmp($recepcion->estado->estado,'En Reparación')==0)
                            <option value="En Reparación" {{$recepcion->estado->opSelected("En Reparación")}}>En Reparación</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','tecnico'])||strcmp($recepcion->estado->estado,'Reparación Terminada')==0)
                            <option value="Reparación Terminada" {{$recepcion->estado->opSelected("Reparación Terminada")}}>Reparación Terminada</option>
                            @endif
                            @if (auth()->user()->tieneRol(['admin','recepcionista'])||strcmp($recepcion->estado->estado,'Equipo Entregado')==0)
                            <option value="Equipo Entregado" {{$recepcion->estado->opSelected("Equipo Entregado")}}>Equipo Entregado</option>
                            @endif
                        </select>
                        <div class="mt-3 d-inline-flex p-0 bd-highlight form-check form-switch d-inline-flex bd-highlight">
                            <input class="form-check-input" type="checkbox" name="interna">
                            <label class="form-check-label" for="tecnico">Nota Interna</label>
                        </div>
                    </div>
                    <div class="col-8">
                        <label for="nota" class="form-label">Nota: </label><br>
                        <textarea  class="form-control border-dark" name="nota" placeholder="" cols="30" rows="3" required>{{ old('nota')}}</textarea><br>
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
</div>

@endsection
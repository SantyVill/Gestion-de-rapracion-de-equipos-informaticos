@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-7">
        <div class="row justify-content-center">
            <section class="text-center">
                <form method="POST" action="{{route('recepciones.update',$recepcion)}}" class="mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
                    @csrf @method('PATCH')
                    <legend class="bg-dark" style="color:rgb(150 150 150)">Editar Recepción</legend>
                    
                    <div class="row mx-auto col-11">
                        <div class="col-6">
                            <label for="falla" class="form-label">Falla: </label>
                            <input type="text" name="falla" class="form-control border-dark"  value="{{$recepcion->falla}}" required maxlength="{{config("tam_falla")}}">
                            {!!$errors->first('falla','<small>:message</small><br>')!!}<br>
                        </div>
                        <div class="col-6">
                            <label for="accesorio" class="form-label">Accesorio: </label>
                            <input type="text" name="accesorio" class="form-control border-dark" value="{{ $recepcion->accesorio }}" required maxlength="{{config("tam_accesorio")}}"><br>
                            {!!$errors->first('accesorio','<small>:message</small><br>')!!}
                        </div>
                    </div>
                    <div class="row mb-0 justify-content-center">
                        <div class="col-5">
                            <label for="estado" class="form-label">Estado: </label>
                            <select class="form-select border-dark" name="estado" aria-label="Default select example">
                                <option value="A presupuestar" {{$recepcion->estado->opSelected("A presupuestar")}}>A presupuestar</option>
                                <option value="En Revisión" {{$recepcion->estado->opSelected("En Revisión")}}>En Revisión</option>
                                <option value="Presupuesto Aceptado" {{$recepcion->estado->opSelected("Presupuesto Aceptado")}}>Presupuesto Aceptado</option>
                                <option value="En Reparación" {{$recepcion->estado->opSelected("En Reparación")}}>En Reparación</option>
                                <option value="Reparación Terminada" {{$recepcion->estado->opSelected("Reparación Terminada")}}>Reparación Terminada</option>
                                <option value="Equipo Entregado" {{$recepcion->estado->opSelected("Equipo Entregado")}}>Equipo Entregado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-0 justify-content-center">
                        <div class="col-8">
                            <label for="observacion" class="form-label">Observación: </label><br>                    
                            <textarea name="observacion" class="form-control border-dark" cols="30" rows="4">{{ old('observacion',$recepcion['observacion'] )}}</textarea><br>
                            {!!$errors->first('observacion','<small>:message</small><br>')!!}
    
                        </div>
                    </div>
                    
                    <div class="row mb-0 justify-content-center mb-2">
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
    <div class="col-4">
        <div class="pb-4 justify-content-center">
            
            <div class="col-11 pb-1">
                <div class="card bg-light border border-secondary border-2 rounded-3" {{-- style="background-color:orangered; border-color:darkblue;" --}}>
                    <div class="card-body">
                        <h5 class="card-title">Equipo Selecionado: </h5>
                        <p class="card-text">
                        <ul>
                            <li>Numero de serie: {{$recepcion->equipo->numero_serie}}</li>
                            <li>Tipo: {{$recepcion->equipo->caracteristica->tipo->tipo}}</li>
                            <li>Marca: {{$recepcion->equipo->caracteristica->marca->marca}}</li>
                            <li>Modelo: {{$recepcion->equipo->caracteristica->modelo}}</li>
                            <li>Observacion: {{$recepcion->equipo->observacion}}</li>
                            <a href="{{route('equipos.update_recepcion',$recepcion)}}" class="btn btn-infobtn btn-primary btn-sm">Elegir otro equipo</a>
                            
                        </ul>
                        </p>
                    </div>
                  </div>
            </div>
            
            <div class="col-11">
                <div class="card bg-light border border-secondary border-2 rounded-3" >
                    <div class="card-body">
                      <h5 class="card-title">Cliente Selecionado: </h5>
                      <p class="card-text">
                          <ul>
                                <li>Apellido y Nombre: {{$recepcion->cliente['apellido'].", ".$recepcion->cliente->nombre}}</li>
                                <li>DNI: {{$recepcion->cliente->dni}}</li>
                                <li>Mail: {{$recepcion->cliente->mail}}</li>
                                <a href="{{route('clientes.update_recepcion',$recepcion)}}" class="btn btn-infobtn btn-primary btn-sm">Elegir otro cliente</a>
                          </ul>
                      </p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
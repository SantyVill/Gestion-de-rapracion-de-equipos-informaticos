@extends('navegacion')

@section('titulo','Crear recepciones')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col ms-2 border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
                <section class="w-100 p-4 text-center pb-4">
                    <form method="POST" action="{{route('recepciones.store')}}">
                        @csrf
                        <legend>Registrar Recepción</legend>
                
                        @if (isset($recepcion))
                        
                        <div class="row mb-0 justify-content-center">
                            <div class="col-6">
                                <label for="falla" class="form-label">Falla: </label>
                                <input type="text" name="falla" class="form-control border-dark"  value="{{ old('falla' ,$recepcion['falla'] )}}" required><br>
                                {!!$errors->first('falla','<small>:message</small><br>')!!}
                            </div>
                            <div class="col-6">
                                <label for="accesorio" class="form-label">Accesorio: </label>
                                <input type="text" name="accesorio" class="form-control border-dark" value="{{ old('accesorio' ,$recepcion['accesorio'] )}}" required><br>
                                {!!$errors->first('accesorio','<small>:message</small><br>')!!}
                            </div>
                        </div>
                        <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br>
                        <div class="row mb-0 justify-content-center">
                            <div class="col-8">
                                <label for="observacion" class="form-label">Observación: </label><br>                    
                                <textarea name="observacion" class="form-control border-dark" cols="30" rows="4">{{ old('observacion',$recepcion['observacion'] )}}</textarea><br>
                                {!!$errors->first('observacion','<small>:message</small><br>')!!}
        
                            </div>
                        </div>
                        
                        
                            
                        @else
                        
                        <div class="row mb-0 justify-content-center">
                            <div class="col-6">
                                <label for="falla" class="form-label">Falla: </label>
                                <input type="text" name="falla" class="form-control border-dark" value="{{ old('falla')}}" required><br>
                                {!!$errors->first('falla','<small>:message</small><br>')!!}
                            </div>
                            <div class="col-6">
                                <label for="accesorio" class="form-label">Accesorio: </label>
                                <input type="text" name="accesorio" class="form-control border-dark" value="{{ old('accesorio')}}" required><br>
                                {!!$errors->first('accesorio','<small>:message</small><br>')!!}
                            </div>
                        </div>
                        <input type="text" name="estado" placeholder="Estado" value="A presupuestar" required hidden><br>
                        <div class="row mb-0 justify-content-center">
                            <div class="col-8">
                                <label for="observacion" class="form-label">Observación: </label><br>                    
                                <textarea name="observacion" class="form-control border-dark" cols="30" rows="4">{{ old('observacion')}}</textarea><br>
                                {!!$errors->first('observacion','<small>:message</small><br>')!!}
        
                            </div>
                        </div>
                        
                        @endif
                        <div class="row mb-0 justify-content-center">
                            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                                @if (!(null!==(Cookie::get('equipo'))))
                                    <input type="submit" value="Selecionar Equipo" class="btn btn-outline-success">
                                @elseif(!(null!==(Cookie::get('cliente'))))
                                    <input type="submit" value="Selecionar Cliente" class="btn btn-outline-success">      
                                @else
                                    <input type="submit" value="Confirmar" class="btn btn-outline-success">
                                @endif
                            </div>
                            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                                <a class="btn btn-outline-danger" href="{{ url()->previous() }}" role="button">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    @if (isset($equipo['id']) || isset($cliente->id))
    <div class="col-4">
        <div class="pb-4 justify-content-center">
            @if (isset($equipo['id']))
            <div class="col-11 pb-1">
                <div class="card bg-light" {{-- style="background-color:orangered; border-color:darkblue;" --}}>
                    <div class="card-body border border-secondary border-2 rounded-3">
                        <h5 class="card-title">Equipo Selecionado: </h5>
                        <p class="card-text">
                        <ul>
                            <li>Numero de serie: {{$equipo->numero_serie}}</li>
                            <li>Tipo: {{$equipo->caracteristica->tipo->tipo}}</li>
                            <li>Marca: {{$equipo->caracteristica->marca->marca}}</li>
                            <li>Modelo: {{$equipo->caracteristica->modelo}}</li>
                            <li>Observacion: {{$equipo->observacion}}</li>
                            <a href="{{route('equipos.select_recepcion')}}" class="btn btn-infobtn btn-primary btn-sm">Elegir otro equipo</a>
                        </ul>
                        </p>
                    </div>
                  </div>
            </div>
            @endif
            @if (isset($cliente->id))
            <div class="col-11">
                <div class="card bg-light" >
                    <div class="card-body border border-secondary border-2 rounded-3">
                      <h5 class="card-title">Cliente Selecionado: </h5>
                      <p class="card-text">
                          <ul>
                              <li>Apellido y Nombre: {{$cliente['apellido'].", ".$cliente->nombre}}</li>
                              <li>DNI: {{$cliente->dni}}</li>
                              <li>Mail: {{$cliente->mail}}</li>
                                <a href="{{route('clientes.select_recepcion')}}" class="btn btn-infobtn btn-primary btn-sm">Elegir otro cliente</a>
                          </ul>
                      </p>
                    </div>
                  </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>



@endsection
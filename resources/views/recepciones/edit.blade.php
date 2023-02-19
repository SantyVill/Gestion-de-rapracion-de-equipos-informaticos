@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
<div class="row">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col-8  border border-dark border-2 rounded-3 justify-content-center bg-formulario" style="background-color: #41aa42">
            
                <section class="w-100 p-4 text-center pb-4">
                    <form class="row g-3" method="POST" action="{{route('recepciones.update',$recepcion)}}">
                        @csrf @method('PATCH')
                        <legend>Editar Recepción</legend>
                
                        @if (isset($recepcion))
                        
                        <div class="row mb-0 justify-content-center">
                            <div class="col-6">
                                <label for="falla" class="form-label">Falla: </label>
                                <input type="text" name="falla" class="form-control border-dark"  value="{{$recepcion->falla}}" required><br>
                                {!!$errors->first('falla','<small>:message</small><br>')!!}
                            </div>
                            <div class="col-6">
                                <label for="accesorio" class="form-label">Accesorio: </label>
                                <input type="text" name="accesorio" class="form-control border-dark" value="{{ $recepcion->accesorio }}" required><br>
                                {!!$errors->first('accesorio','<small>:message</small><br>')!!}
                            </div>
                        </div>
                        <input type="text" name="estado" value="A presupuestar" required hidden><br>
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
    </div>
    <div class="col-4">
        <div class="pb-4 justify-content-center">
            
            <div class="col-11 pb-1">
                <div class="card bg-light" {{-- style="background-color:orangered; border-color:darkblue;" --}}>
                    <div class="card-body border border-secondary border-2 rounded-3">
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
                <div class="card bg-light" >
                    <div class="card-body border border-secondary border-2 rounded-3">
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
 
    {{-- <form class="row g-3" method="POST" action="{{route('recepciones.update',$recepcion)}}">
        @csrf @method('PATCH')

        <div class="col-md-6">
            <label for="falla" class="form-label">Falla</label>
            <input type="text" name="falla" placeholder="Falla" value="{{$recepcion->falla}}" required><br>
            {!!$errors->first('falla','<small>:message</small><br>')!!} 
        </div>
        <div class="col-md-6">
            <label for="accesorio" class="form-label">Accesorio</label>
            <input type="text" name="accesorio" placeholder="Accesorio" value="{{$recepcion->accesorio}}" required><br>
            {!!$errors->first('accesorio','<small>:message</small><br>')!!}
        </div>
        <div class="col-12">
            <label for="observacion" class="form-label">Observacion</label><br>
            <textarea name="observacion" placeholder="Observacion" cols="30" rows="10">{{ $recepcion->observacion}}</textarea><br>
            {!!$errors->first('observacion','<small>:message</small><br>')!!}
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        <input type="submit" value="Enviar"><br>
        <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
    </form> --}}
@endsection
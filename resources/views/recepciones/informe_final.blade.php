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
                        <textarea  class="form-control border-dark" name="informe_final" placeholder="" cols="30" rows="3" required>{{ old('informe_final',$recepcion->informe_final)}}</textarea><br>
                        {!!$errors->first('informe_final','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5">
                        <label for="precio" class="form-label">Monto total: </label>
                        <input type="text" class="form-control border-dark" name="precio" placeholder="" value="{{ old('precio',$recepcion->precio)}}"><br>
                        {!!$errors->first('precio','<small>:message</small><br>')!!}
                    </div>
                    <div class="col-5">
                        <label for="garantia" class="form-label">Garantia: </label>
                        <input type="date" class="form-control border-dark" name="garantia" placeholder="" value="{{ old('garantia',$recepcion->garantia)}}"><br>
                        {!!$errors->first('garantia','<small>:message</small><br>')!!}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="dropend">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Ver precios del modelo {{$recepcion->equipo->caracteristica->modelo}}
                        </button>
                        <div class="position-fixed top-50 start-50 translate-middle dropdown-menu p-1 justify-content-center" style="background-color: rgb(196, 231, 255)">
                            <h6 class="dropdown-header">Lista de precios de modelo: {{$recepcion->equipo->caracteristica->modelo}}</h6>
                            <table class="table table-hover table-striped table-bordered bg-white border-2 border-dark rounded m-0">
                                <tr>
                                    <th>Reparacion</th>
                                    <th>Precio</th>
                                    <th>Plazo</th>
                                    <th>Riesgo</th>
                                </tr>
                                @forelse ($recepcion->equipo->caracteristica->precios as $precio)
                                <tr>
                                    <td>{{$precio->reparacion}}</td>
                                    <td>{{$precio->precio}}</td>
                                    <td>
                                        @if ($precio->plazo)
                                        {{$precio->plazo}} dias
                                        @endif
                                    </td>
                                    <td>{{$precio->riesgo}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><p>No se registraron precios</p></td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Enviar" class="btn btn-success">
                <a class="btn btn-danger" href="{{ route('recepciones.show',$recepcion) }}" role="button">Volver</a>
            </form>
        </section>
    </div>
</section>
@endsection
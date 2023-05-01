@extends('navegacion')

@section('titulo','Editar recepcion')

@section('contenido')
<section class="m-0-auto  text-center">
    <form method="POST" action="{{route('recepciones.agregarInforme',$recepcion)}}" class="col-8 mx-auto rounded-3 align-items-center bg-form border border-2 border-dark justify-content-center">
        @csrf @method('PATCH')
        <legend class="bg-dark" style="color:rgb(150 150 150)">Agregar Informe</legend>
        <div class="row mb-0 justify-content-center">
            <div class="col-8">
                <label for="informe_final" class="form-label">Informe Final: </label><br>
                <textarea  class="form-control border-dark" name="informe_final" cols="30" rows="3">{{ old('informe_final',$recepcion->informe_final)}}</textarea>
                {!!$errors->first('informe_final','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-5">
                <label for="precio" class="form-label">Monto total: </label>
                <input type="text" class="form-control border-dark" name="precio" value="{{ old('precio',$recepcion->precio)}}" maxlength="{{config("tam_precio")}}">
                {!!$errors->first('precio','<small>:message</small><br>')!!}<br>
            </div>
            <div class="col-5">
                <label for="garantia" class="form-label">Garantia: </label>
                <input type="date" class="form-control border-dark" name="garantia" value="{{ old('garantia',$recepcion->garantia)}}">
                {!!$errors->first('garantia','<small>:message</small><br>')!!}<br>
            </div>
        </div>
        <div class="row mb-3">
            <div class="dropend">
                <button class="btn border-dark btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                    
        <div class="row mb-0 justify-content-center mb-2">
            <div class="col-4 me-4 w-auto p-1 rounded " style="background-color: rgb(232, 240, 247)">
                <input type="submit" value="Registrar" class="btn btn-outline-success">
            </div>
            <div class="col-4 ms-4 w-auto p-1 rounded" style="background-color: rgb(232, 240, 247)">
                <a class="btn btn-outline-danger" href="{{ route('recepciones.show',$recepcion) }}" role="button">Cancelar</a>
            </div>
        </div>
    </form>
</section>
@endsection
@extends('navegacion')

@section('titulo','Editar Precio')

@section('contenido')
    <h1>Aqui se editara el precio</h1>
    <form method="POST" action="{{route('precios.update',$precio)}}">
        @csrf @method('PATCH')
        <input type="text" name="reparacion" placeholder="Reparacion" value="{{ old('reparacion',$precio->reparacion)}}" required><br>
        {!!$errors->first('reparacion','<small>:message</small><br>')!!}

        <input type="number" name="precio" placeholder="Precio" value="{{ old('precio',$precio->precio)}}" required><br>
        {!!$errors->first('num_serie','<small>:message</small><br>')!!}
        
        <input type="date" name="plazo" placeholder="Plazo" value="{{ old('plazo',$precio->plazo)}}" required><br>
        {!!$errors->first('plazo','<small>:message</small><br>')!!}
        
        <input type="text" name="riesgo" placeholder="Riesgo" value="{{ old('riesgo',$precio->riesgo)}}" required><br>
        {!!$errors->first('riesgo','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
        <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
    </form>
@endsection
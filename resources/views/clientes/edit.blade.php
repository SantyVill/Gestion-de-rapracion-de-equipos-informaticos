@extends('navegacion')

@section('titulo','editar titulo')

@section('contenido')
    <h1>Aqui se editara el Cliente</h1>
    <form method="POST" action="{{route('clientes.update',$cliente)}}">
        @csrf @method('PATCH')
        <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre',$cliente->nombre)}}" required><br>
        {!!$errors->first('nombre','<small>:message</small><br>')!!}
        
        <input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido',$cliente->apellido)}}" required><br>
        {!!$errors->first('apellido','<small>:message</small><br>')!!}
        
        <input type="text" name="dni" placeholder="dni" value="{{ old('dni',$cliente->dni)}}" ><br>
        {!!$errors->first('dni','<small>:message</small><br>')!!}
        
        <input type="text" name="telefono1" placeholder="telefono1" value="{{ old('telefono1',$cliente->telefono1)}}" required><br>
        {!!$errors->first('telefono1','<small>:message</small><br>')!!}
        
        <input type="text" name="telefono2" placeholder="telefono2" value="{{ old('telefono2',$cliente->telefono2)}}" ><br>
        {!!$errors->first('telefono2','<small>:message</small><br>')!!}
        
        <input type="text" name="direccion" placeholder="direccion" value="{{ old('direccion',$cliente->direccion)}}" ><br>
        {!!$errors->first('direccion','<small>:message</small><br>')!!}

        <input type="text" name="mail" placeholder="Ccorreo Electronico" value="{{ old('mail',$cliente->mail)}}" ><br>
        {!!$errors->first('mail','<small>:message</small><br>')!!}
        
        {{-- <input type="text" name="observacion" placeholder="Observacion" value="{{ old('observacion',$equipo->observacion)}}" required><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!} --}}
        
        <textarea name="observacion" placeholder="Observacion" value="prueba" cols="30" rows="10">{{ old('Observacion',$cliente->observacion)}}</textarea><br>
        {!!$errors->first('observacion','<small>:message</small><br>')!!}
    
        <input type="submit" value="Enviar"><br>
        <a class="btn btn-danger" href="{{ url()->previous() }}" role="button">Volver</a>
    </form>
@endsection
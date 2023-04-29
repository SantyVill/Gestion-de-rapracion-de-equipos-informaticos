@extends('navegacion')

@section('titulo','Ver Cliente')

@section('contenido')
<div class="d-flex justify-content-center">
    <div class="card d-inline-block mx-auto border-dark" style="margin: 0 auto">
        <div class="card-header h4 text-center bg-dark text-light p-1">
            Datos del Cliente
        </div>
        <div class="card-body p-0">
            <table class="table p-0 m-0 w-100 table-responsive table-info table-hover table-striped table-bordered border-2 border-dark shadow rounded">
                <tr>
                    <th>Nombre</th><th>Apellido</th><th>DNI</th><th>Telefono 1</th><th>Telefono 2</th><th>Dirección</th>
                    <th>Correo Electronico</th><th>Obs:</th><th colspan="2" class="text-center">Acciones</th>
                </tr>
                <tr>
                    <td>{{$cliente->nombre}}</td>
                    <td>{{$cliente->apellido}}</td>
                    <td>{{$cliente->dni}}</td>
                    <td>{{$cliente->telefono1}}</td>
                    <td>{{$cliente->telefono2}}</td>
                    <td>{{$cliente->direccion}}</td>
                    <td>{{$cliente->mail}}</td>
                    <td>{{$cliente->observacion}}</td>
                    <td class="text-center ps-0 pe-0">
                        <a href="{{route('clientes.edit',$cliente)}}" class="">
                            <button type="button" class="btn p-1 mx-1 btn-sm btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>
                        </a>
                    </td>
                    
                    <td class="text-center mx-1 ps-0 pe-0">
                        <form method="POST" action="{{route('clientes.destroy',$cliente)}}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm p-1 btn-danger" onclick="return confirm('¿Está seguro que desea  el cliente {{$cliente->apellido.', '.$cliente->nombre}}?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                    {{-- <td>
                        <form method="POST" action="{{route('equipos.destroy',$equipo)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td> --}}
                </tr>
            </table>
        </div>
    </div>
</div>
<h3 class="text-center mt-2 mb-0" style="">Recepciones del cliente</h3>
<div class="d-flex justify-content-center">
    <div class="card d-inline-block mx-auto border-dark" style="margin: 0 auto">
        <div class="card-body p-0">
            <table class="table p-0 m-0 w-100 table-responsive table-info table-hover table-striped table-bordered border-2 border-dark shadow rounded">
                <tr class="text-center"> 
                    <th style="width: 6em;">N° Orden</th>
                    <th>Modelo</th><th>Marca</th><th>Número de Serie</th><th>Fecha Recepción</th>
                    <th>Falla:</th>
                    <th>Estado:</th>
                </tr>
                @forelse ($cliente->recepciones->sortByDesc('fecha_recepcion') as $recepcion)
                <tr>
                    <td class="text-center">{{$recepcion->id}}</td>
                    <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
                    <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
                    <td><a href="{{route('equipos.show',$recepcion->equipo)}}">{{$recepcion->equipo->numero_serie}}</a></td>
                    <td>{{date('d-m-y',strtotime($recepcion->fecha_recepcion))}}</td>
                    <td>{{$recepcion->falla}}</td>
                    <td>{{$recepcion->estado->estado}}</td>
                    <td class="p-1 text-center col-1"><a href="{{route('recepciones.show',$recepcion)}}" class="btn btn-primary">Ver</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        <p>No se encontró ninguna recepción</p>
                    </td>
                </tr>
                @endforelse
            </table>
@endsection
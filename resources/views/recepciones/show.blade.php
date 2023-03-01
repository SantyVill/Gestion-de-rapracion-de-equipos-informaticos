@extends('navegacion')

@section('titulo','Ver Recepcion')

@section('contenido')
    <table class="table table-striped table-bordered">
    
      {{--  @if (!$clientes)--}}
            <tr>
                <th>Fecha Recepción</th>
                <th>Estado</th>
                <th>Observacíon</th>
                <th>Falla:</th>
                @if (auth()->user()->tieneRol(['admin','recepcionista']))
                <th>Monto total</th>
                <th>Cliente</th>
                @endif
                <th colspan="2" class="text-center">Acciones</th>
            </tr>
       {{-- @endif--}}
        <tr>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->estado->estado}}</td>
            <td>{{$recepcion->observacion}}</td>
            <td>{{$recepcion->falla}}</td>
            <td>${{$recepcion->precio}}</td>
            @if (auth()->user()->tieneRol(['admin','recepcionista']))
            @if (isset($recepcion->cliente))
            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            @else
            <td>Cliente Eliminado.</td>
            @endif
            @endif
            <td>
                <a class="" href="{{route('recepciones.edit',$recepcion)}}">
                    <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </button>
                </a>
            </td>
            {{-- <td>
                <button type="button" class="btn btn-primary">
                    <a class="link-light" href="{{route('revisiones.create',$recepcion)}}">Agregar Revision</a>
                </button>
            </td> --}}
            {{-- <td>
                <button type="button" class="btn btn-primary">
                    <a class="link-light" href="{{route('recepciones.informe_final',$recepcion)}}">{{$recepcion->informe_final?'Editar informe final':'Agregar informe final'}}</a>
                </button>
            </td> --}}
        
            <td>
                <form method="POST" action="{{route('recepciones.destroy',$recepcion)}}">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea borrar?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
    </table>       
    <div class="container">
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="3" class="text-center">Equipo</th>
                    </tr>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Número de Serie</th>
                    </tr>
                    <tr>
                        @if (isset($recepcion->equipo))
                        <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
                        <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
                        <td><a href="{{route('equipos.show',$recepcion->equipo)}}">{{$recepcion->equipo->numero_serie}}</a></td>
                        @else
                            <td colspan="3" class="text-center">Equipo Eliminado.</td>
                        @endif
                    </tr>
                </table>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5"><h5 class="card-title pt-2">Informe Final:</h5></div>
                            <div class="col-7 text-end">
                                <a href="{{route('recepciones.informe_final',$recepcion)}}">
                                    <button class="btn btn-primary" >
                                        @if ($recepcion->informe_final)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                            Editar informe final
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                                <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z"/>
                                            </svg>
                                            Agregar informe final
                                        @endif
                                    </button>
                                </a>
                            </div>
                        </div>
                      <p class="card-text">{{$recepcion->informe_final}}</p>
                      <p class="card-text"><b>Garantía:</b> {{$recepcion->garantia}}</p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <table class="table  table-bordered"> 
        <thead class="thead-dark">
        <tr class="d-flex">
            <th class="col-8">
                <div class="row">
                    <div class="col-5">Notas</div>
                    <div class="col-7 text-end">
                        
                            <a href="{{route('revisiones.create',$recepcion)}}">
                                <button type="button" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                    </svg>
                                    Agregar Revision
                                </button> 
                            </a>
                   
                    </div>
                </div>
            </th>
            <th class="col-2">Fecha</th>
            <th class="col-2">Usuario</th>
        </tr>
        </thead>
        @forelse ($recepcion->revisiones as $revision)
            <tr class="d-flex {{($revision->tecnico_id==auth()->user()->id)?'table-info':'table-success'}}">
                <td class="col-8">{{$revision->nota}}</td>
                <td class="col-2 text-center">{{$revision->fecha}}</td>
                @if (isset($revision->user))
                    <td class="col-2 text-center">{{$revision->user->apellido.', '.$revision->user->nombre}}</td> 
                @else
                    <td class="col-2 text-center">Usuario Eliminado.</td> 
                @endif
                {{-- <td>{{User::find($revision->tecnico_id)->apellido.', '.User::find($revision->tecnico_id)->nombre}}</td> --}}
            </tr>        
        @empty
            <p>No se agregó ninguna revisión</p>
        @endforelse
    </table> 
            
            {{-- @forelse ($recepcion->revisiones as $revision)
            <div class="container">
              <div class="mx-auto card text-dark {{($revision->tecnico_id==auth()->user()->id)?'border-info':'border-warning'}} mb-3">
                <div class="container">
                <div class="card-header row">
                    @if (isset($revision->user))
                        <div class="col-9">{{$revision->user->apellido.', '.$revision->user->nombre}}</div>
                    @else
                        <div class="col-9">Usuario Eliminado.</div>
                    @endif
                    <div class="col-3">{{$revision->fecha}}</div>
                </div>
                </div>
                <div class="card-body">
                  <p class="card-text">{{$revision->nota}}</p>
                </div>
              </div>
            </div>  
            @empty
                <p>No se agregó ninguna revisión</p>
            @endforelse --}}
            





    
@endsection

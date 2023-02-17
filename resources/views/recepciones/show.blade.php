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
                <th>Cliente</th>
                @endif
                <th colspan="4" class="text-center">Acciones</th>
            </tr>
       {{-- @endif--}}
        <tr>
            <td>{{$recepcion->fecha_recepcion}}</td>
            <td>{{$recepcion->estado->estado}}</td>
            <td>{{$recepcion->observacion}}</td>
            <td>{{$recepcion->falla}}</td>
            @if (auth()->user()->tieneRol(['admin','recepcionista']))
            @if (isset($recepcion->cliente))
            <td><a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a></td>
            @else
            <td>Cliente Eliminado.</td>
            @endif
            @endif
            <td><button type="button" class="p-0 btn btn-warning">
                <a class=" btn btn-primary" href="{{route('recepciones.edit',$recepcion)}}">Editar</a>
            </button></td>
            <td>
                <button type="button" class="btn btn-primary">
                    <a class="link-light" href="{{route('revisiones.create',$recepcion)}}">Agregar Revision</a>
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-primary">
                    <a class="link-light" href="{{route('recepciones.informe_final',$recepcion)}}">{{$recepcion->informe_final?'Editar informe final':'Agregar informe final'}}</a>
                </button>
            </td>
        
            <td>
                <form method="POST" action="{{route('recepciones.destroy',$recepcion)}}"onclick="return confirm('¿Está seguro que desea borrar?')">
                    <button class="btn btn-danger">Eliminar</button>
                    @csrf @method('DELETE')
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
                      <h5 class="card-title">Informe Final</h5>
                      <p class="card-text">{{$recepcion->informe_final}}</p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <table class="table  table-bordered"> 
        <thead class="thead-dark">
        <tr class="d-flex">
            <th class="col-8">Notas</th>
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
            
            
            {{-- <div class="card caht-app">
                <div class="chat">
                    <div class="chat-history">
                        <ul class="m-b-0">
                            <li class="clearfix">
                                <div class="message-data text-right"> <span class="message-data-time">10:10 AM, Today</span>
                                    <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming
                                        along?</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data"> <span class="message-data-time">10:12 AM, Today</span></div>
                                        <div class="message my-message">Are we meeting today?</div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="message-data"> <span class="message-data-time">10:15 AM, Today</span></div>
                                <div class="message my-message">Project has been already finished and I have results to show
                                    you.</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            @forelse ($recepcion->revisiones as $revision)
            <div class="container">
              <div class="mx-auto card text-dark {{($revision->tecnico_id==auth()->user()->id)?'border-info':'border-warning'}} mb-3" {{-- style="max-width: 70%;" --}}>
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
            @endforelse
            

                {{-- <tr  class="{{($revision->tecnico_id==auth()->user()->id)?'table-info':'table-success'}}">
                    <td>{{$revision->nota}}</td>
                    <td>{{$revision->fecha}}</td>
                    <td>{{$revision->user->apellido.', '.$revision->user->nombre}}</td> 
                </tr> --}}





    
@endsection

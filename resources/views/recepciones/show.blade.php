@extends('navegacion')

@section('titulo','Ver Recepcion')

@section('contenido')
<div class="row mx-1{{-- row-cols-1 row-cols-md-2 g-2 --}}">
    {{-- ==================== CARD Recepción ============================ --}}
    <div class="col-7">
        <div class="card bg-card-recepcion border-dark mb-3">
            <div class="card-header bg-card-recepcion-header p-1 ps-3">
                <div class="row">
                    <div class="col-8">
                        <h5 class="card-title m-0"><b>Datos de recepción</b></h5>
                    </div>
                    <div class="col-4 d-flex justify-content-between">
                    {{-- BOTON GENERAR PDF INFORME --}}
                        <a class="btn btn-info border-dark btn-sm {{$recepcion->terminada()}}" target="_blank" href="{{route('recepciones.generarPdfIngreso',$recepcion)}}" title="Generar pdf de ingreso">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                            </svg>
                            Ingreso                    
                        </a>
                    {{-- BOTON EDITAR RECEPCION --}}
                        <a class="btn btn-primary border-dark btn-sm {{(auth()->user()->tieneRol(['admin','recepcionista']))?'':($recepcion->terminada())}}" href="{{route('recepciones.edit',$recepcion)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                    {{-- BOTON ELIMINAR RECEPCION --}}
                        <form method="POST" action="{{route('recepciones.destroy',$recepcion)}}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger border-dark btn-sm {{$recepcion->terminada()}}" onclick="return confirm('¿Está seguro que desea borrar esta Recepción?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                        <div class="card-body text-dark">
                        <p class="card-text m-0">
                            <b class="">Numero de orden:</b> {{$recepcion->id}}<br>
                            <b>Fecha{{-- de recepcion --}}:</b> {{$recepcion->fecha_recepcion}} <br>
                            <b>Estado:</b> {{$recepcion->estado->estado}} <br>
                            <b>Falla:</b> {{$recepcion->falla}} <br>
                            <b>Observación: </b> {{$recepcion->observacion}} <br>
                        </p>
                    </div>
    
                </div>
                <div class="col-5 mt-2 justify-content-end ms-5">
                    <div class="card bg-card-recepcion-elemento border-primary mb-1">
                        <div class="card-body text-dark">
                            <h5 class="card-title m-0"><b>Datos de Equipo</b></h5>
                            <p class="card-text">
                                <b>Numero de serie:</b> <a href="{{route('equipos.show',$recepcion->equipo)}}">{{$recepcion->equipo->numero_serie}}</a><br>
                                <b>Marca:</b> {{$recepcion->equipo->caracteristica->marca->marca}} <br>
                                <b>Modelo:</b> {{$recepcion->equipo->caracteristica->modelo}}
                            </p>
                        </div>
                    </div>
                    <div class="card bg-card-recepcion-elemento border-primary mb-2">
                        <div class="card-body text-dark">
                            <h5 class="card-title m-0"><b>Datos de Cliente</b></h5>
                            <p class="card-text">
                                <b>Nombre:</b> <a href="{{route('clientes.show',$recepcion->cliente)}}">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</a> <br>
                                <b>Telefono:</b> {{$recepcion->cliente->telefono1}}{{($recepcion->cliente->telefono2)?' / '.$recepcion->cliente->telefono2:''}} <br>
                                <b>e-Mail:</b> {{$recepcion->cliente->mail}} <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card bg-card-recepcion border-dark mb-3">
          <div class="card-header bg-card-recepcion-header p-1 ps-3">
            <div class="row w-100">
                <div class="col-5 p-0">
                    <h5 class="card-title m-0"><b>Información de reparación</b></h5>
                </div>
                {{-- BOTON GENERAR INFORME --}}
                <div class="col-7 d-flex justify-content-end p-0">
                    <a class="me-1 btn btn-sm border-dark btn-info {{$recepcion->informe_final==null?'disabled':''}}" target="_blank" href="{{route('recepciones.generarPdfInforme',$recepcion)}}">
                        {{-- <button type="button" class=""> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                            </svg>
                            Generar Informe
                        {{-- </button> --}}
                    </a>
                {{-- BOTON AGREGAR/EDITAR INFORME --}}
                    <a href="{{route('recepciones.informe_final',$recepcion)}}" class="btn p-1 btn-sm border-dark btn-primary {{$recepcion->terminada()}} {{$recepcion->estado->estado!="Reparación Terminada"?'disabled':''}}" >
                        @if ($recepcion->informe_final)
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                            Editar informe
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z"/>
                            </svg>
                            Agregar informe 
                        @endif
                    </a>
                
                </div>
            </div>
        </div>




          <div class="card-body text-dark">
            <p class="card-text m-0">
              <b>Informe:</b> {{$recepcion->informe_final}}<br>
            </p>
            <b>Garantía:</b>
            @if ($recepcion->garantia)
                
            <p class="btn btn-sm m-0 d-inline-block p-1 {{(now()->startOfDay()>\Carbon\Carbon::parse($recepcion->garantia)->startOfDay())?'bg-danger':'btn-garantia-success'}}  border rounded-pill" onclick="return alert('{{(now()->startOfDay()>\Carbon\Carbon::parse($recepcion->garantia)->startOfDay())?'La garantia caducó':'La garantía sigue en vigencia'}}')">
                @if (now()->startOfDay()>\Carbon\Carbon::parse($recepcion->garantia)->startOfDay())
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path class="" d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"></path>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                @endif
                {{$recepcion->garantia}}
            </p>
            @endif
            <br>
            <b>Monto:</b> {{'$'.$recepcion->precio}}<br>
            <b>Fecha de entrega:</b> {{$recepcion->fecha_entrega}}<br>
          </div>
        </div>
      </div>
  </div>

{{-- ===========================================================================
=============================================Tabla de Revisiones================
 ===============================================================================--}}
 <div class=" mx-1 border border-dark mt-2 bg-dark">
    <table class="table table-dark table-bordered table-sm m-0"> 
         <tr class="">
             <th class="col-7">
                 <div class="row">
                     <div class="col-5">Notas</div>
                     <div class="col-7 text-end">
                         
                             <a href="{{route('revisiones.create',$recepcion)}}" class="btn btn-primary btn-sm {{$recepcion->terminada()}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                                     <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                                     <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                     <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                 </svg>
                                 Agregar Nota
                             </a>
                    
                     </div>
                 </div>
             </th>
             <th class="col-2">Fecha</th>
             <th class="col-2">Usuario</th>
             <th class="col-1">Acciones</th>
         </tr>
         </thead>
         @forelse ($recepcion->revisiones as $revision)
             @if ($revision->ocultar())
                 <tr class=" {{($revision->tecnico_id==auth()->user()->id)?'table-info':'table-success'}}">
                     <td class="">{{ $revision->nota}}</td>
                     <td class=" text-center">{{$revision->fecha}}</td>
                     @if (isset($revision->user))
                         <td class=" text-center">{{$revision->user->apellido.', '.$revision->user->nombre}}</td> 
                     @else
                         <td class=" text-center">Usuario Eliminado.</td> 
                     @endif
                     <td>
                         @if ($revision->tecnico_id==auth()->user()->id)
                         <div class="row">
                             <div class="col text-end me-0">
                                 <a class="btn btn-primary btn-sm {{$recepcion->terminada()}}" href="{{route('revisiones.edit',$revision)}}">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                         <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                     </svg>
                                 </a>
                             </div>
                             <div class="col text-start">
                                 <form method="POST" action="{{route('revisiones.destroy',$revision)}}">
                                     @csrf @method('DELETE')
                                     <button type="submit" class="btn btn-danger btn-sm {{$recepcion->terminada()}}" onclick="return confirm('¿Está seguro que desea borrar esta Nota?')">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                             <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                                         </svg>
                                     </button>
                                 </form>
                             </div>
                         </div>
                         @endif
                     </td>
                 </tr>        
             @endif
         @empty
         <tr>
            <td class="text-center table-success" colspan="4">
                <p>No se agregó ninguna nota</p>
            </td>
         </tr>
         @endforelse
     </table> 
 </div>

    
@endsection

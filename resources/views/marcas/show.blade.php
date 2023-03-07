@extends('navegacion')

@section('titulo','Lista de precios')

@section('contenido')
<table class=" w-auto table table-success table-hover table-striped table-bordered bg-white border-2 border-dark shadow rounded">
    <tr>
        <th>
            <div class="row">
                <div class="col-3">Modelo</div>
                @if (auth()->user()->tieneRol(['admin','recepcionista']))    
                    <div class="col-9 text-end">
                        <a class="btn btn-success" href="{{route('modelos.create',$marca)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                            </svg>
                            Agregar modelo
                        </a>
                    </div>
                @endif
            </div>
             
        </th>
        <th colspan="4" class="text-center">Acciones</th>
    </tr>
    @forelse ($marca->caracteristicas as $caracteristica)
    <tr>
        <td>{{$caracteristica->modelo}}</td>
        <td>
            <div class="dropend">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Ver Lista de Precios
                </button>
                <div class="position-fixed top-50 start-50 translate-middle dropdown-menu p-1 justify-content-center" style="background-color: rgb(196, 231, 255)">
                    <h6 class="dropdown-header">Lista de precios de modelo: {{$caracteristica->modelo}}</h6>
                    <table class="table table-hover table-striped table-bordered bg-white border-2 border-dark rounded m-0">
                        <tr>
                            <th>Reparacion</th>
                            <th>Precio</th>
                            <th>Plazo</th>
                            <th>Riesgo</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                        @forelse ($caracteristica->precios as $precio)
                        <tr>
                            <td>{{$precio->reparacion}}</td>
                            <td>{{$precio->precio}}</td>
                            <td>
                                @if ($precio->plazo)
                                    {{$precio->plazo}} dias
                                @endif
                            </td>
                            <td>{{$precio->riesgo}}</td>
                            <td>
                                <a href="{{route('precios.edit',$precio)}}" class="">
                                    <button type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </button>   
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="{{route('precios.destroy',$precio)}}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea borrar el precio de esta reparación?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><p>No se registraron precios</p></td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </td>
        @if (auth()->user()->tieneRol(['admin']))
        <td>
            <a class="btn btn-success" href="{{route('precios.create',$caracteristica)}}">Agregar nueva reparacion</a>
        </td>
        @endif
        @if (auth()->user()->tieneRol(['admin','recepcionista']))
        <td>
            <a class="btn btn-primary" href="{{route('modelos.edit',$caracteristica)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
        </td>
        @endif
        @if (auth()->user()->tieneRol(['admin']))
        <td>
            <form method="POST" action="{{route('modelos.destroy',$caracteristica)}}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea borrar el Modelo: {{$caracteristica->modelo}}?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path>
                    </svg>
                </button>
            </form>
        </td>
        @endif
    </tr>
    @empty
    <tr>
        <td colspan="2" class="text-center">No se registró ningun modelo para esta marca.</td>
    </tr>
    @endforelse
</table>
@forelse ($marca->caracteristicas as $caracteristica)

@empty
@endforelse
@endsection
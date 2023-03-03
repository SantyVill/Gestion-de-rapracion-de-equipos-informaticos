<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <title>{{$recepcion->cliente->apellido.$recepcion->cliente->nombre.$recepcion->fecha_recepcion}}</title>
    <style type="">
        *{
            margin: 0;
            padding: 0;
            border: 0;
        }
        .th1 {text-align: center;border-style: solid;border-color: black;border-width: 1px; font-size: 1.1em;}
        table{
            width: 40em;
            margin: 0 auto; margin-top: 1em;
        }
        .tablas{
            border-color: black;border-style: solid;border-width: 1px;width: 40em;
            margin: 0 auto; margin-top: 1em;
        }
        th{text-align: center}
        
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="3">Nombre</th>
        </tr>
        <tr>
            <th>Direccion: </th>
            <th>Telefono: </th>
            <th>Correo Electrónico: </th>
        </tr>
        <tr>
            <td style="text-align: center">Direccion de prueba</td>
            <td style="text-align: center">03814685394</td>
            <td style="text-align: center">pruba@gmail.com</td>
        </tr>
    </table>
    <table class="tablas">
        <tr class="th1">
            <td colspan="2"><b> Número de orden:</b> {{$recepcion->id}}</th>
            <td colspan="2"><b>Fecha de Ingreso:</b>{{$recepcion->fecha_recepcion}}</th>
        </tr>
        <tr>
            <th>Cliente: </th>
            <td colspan="">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</td>
            <th>Correo Electrónico: </th>
            <td colspan="">{{$recepcion->cliente->mail}}</td>
        </tr>
        <tr>
            <th>Telefono: </th>
            <td>{{$recepcion->cliente->telefono1}}</td>
            <td colspan="2">{{$recepcion->cliente->telefono2}}</td>
        </tr>
        <tr>
            <th>Accesorios: </th>
            <td>{{$recepcion->accesorio}}</td>
        </tr>
        <tr>
            <th>Observacíon</th>
            <td colspan="3">{{$recepcion->observacion}}</td>    
        </tr>
        <tr>
            <th>Falla:</th>
            <td>{{$recepcion->falla}}</td>
        </tr>
    </table>
    <table class="tablas">
        <tr>
            <th class="th1" colspan="3">Datos de Equipo</th>
        </tr>
        <tr>
            <th>Modelo: </th>
            <td>{{$recepcion->equipo->caracteristica->modelo}}</td>
        </tr>
        <tr>
            {{-- @if (isset($recepcion->equipo)) --}}
            <th>Marca: </th>
            <td>{{$recepcion->equipo->caracteristica->marca->marca}}</td>
            {{-- @else
            <td colspan="3" >Equipo Eliminado.</td>
            @endif --}}
        </tr>
        <tr>
            <th>Número de Serie: </th>
            <td>{{$recepcion->equipo->numero_serie}}</td>
        </tr>
        <tr>
            <th>Identificación: </th>
            <td>{{$recepcion->equipo->observacion}}</td>
        </tr>
    </table>
</body>
</html>
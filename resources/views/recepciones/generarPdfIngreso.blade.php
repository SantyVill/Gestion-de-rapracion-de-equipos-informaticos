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
            border-color: black;border-style: solid;border-width: 1px;width: 40em; margin-bottom: 2em;
            margin: 0 auto; margin-top: 2em;
        }
        th{text-align: center}
        /* table tr {border-color: black;border-style: solid;border-width: 1px} */
        /* th {border-color: black;border-style: solid;border-width: 1px;text-align: center} */
    </style>
</head>
<body>
    <table>
        <tr>
            <th class="th1" colspan="5">Datos de Recepción</th>
        </tr>
        <tr>
            <th>Fecha de Ingreso:</th>
            <td>{{$recepcion->fecha_recepcion}}</td>
        </tr>
        <tr>
            <th>Accesorios: </th>
            <td>{{$recepcion->accesorio}}</td>
        </tr>
        <tr>
            <th>Observacíon</th>
            <td>{{$recepcion->observacion}}</td>    
        </tr>
        <tr>
            <th>Falla:</th>
            <td>{{$recepcion->falla}}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th class="th1" colspan="3">Datos de Cliente</th>
        </tr>
        <tr>
            <th>Apellido y nombre: </th>
            <td colspan="2">{{$recepcion->cliente->apellido.', '.$recepcion->cliente->nombre}}</td>
        </tr>
        <tr>
            <th>Correo Electrónico: </th>
            <td colspan="2">{{$recepcion->cliente->mail}}</td>
        </tr>
        <tr>
            <th>Telefono: </th>
            <td>{{$recepcion->cliente->telefono1}}</td>
            <td>{{$recepcion->cliente->telefono2}}</td>
        </tr>
    </table>
    <table>
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
            <th>Observación: </th>
            <td>{{$recepcion->equipo->observacion}}</td>
        </tr>
    </table>
</body>
</html>
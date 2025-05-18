<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            border: none;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .footer div {
            width: 48%;
        }

        .signature {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $bien->bien->nombre }}</h1>
        <table>
            <thead>
                <tr>
                    <th colspan="2" style="font-size: 22px; font-weight: bold; text-align: center;">IPASME.</th>
                    <th style="font-size: 16px; text-align: center;">
                        <strong>{{$bien->codigo_inventario}}</strong>
                    </th>
                </tr>
                <tr>
                    <th style="font-size: 16px; text-align: center;">Fecha de Adquisición:</th>
                    <td style="font-size: 16px;">{{$bien->movimiento->fecha->format('d-m-Y')}}</td>
                    <th style="font-size: 16px; text-align: center;"> </th>
                </tr>
            </thead>
        </table>

        <!-- Datos del Cliente -->
        <table>
            <thead>
                <tr>
                    <th>DESCRIPCIÓN</th>
                    <th>USUARIO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$bien->movimiento->descripcion}}</td>
                    <td>{{$bien->movimiento->user->name}}</td>
                </tr>
            </tbody>
        </table>

        <!-- Conceptos de los productos -->
        <table>
            <thead>
                <tr>
                    <th>TIPO</th>
                    @if (isset($movimiento->enteOrigen))
                         <th>ENTE ORIGEN</th>
                    @endif

                    <th>ENTE DESTINO</th>
                    @if (isset($movimiento->departamentoOrigen))
                        <th>DEPARTAMENTO ORIGEN</th>
                    @endif

                    <th>DEPARTAMENTO DESTINO</th>
                    <th>FECHA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movimientos as $index => $movimiento)
                    <tr class="{{ $index === 0 ? 'table-success' : 'table-danger' }}">

                        <td>{{ $movimiento->tipo }}</td>
                         @if (isset($movimiento->enteOrigen))
                        <td>{{ optional($movimiento->enteOrigen)->nombre ?? '-' }}</td>
                         @endif
                        <td>{{ optional($movimiento->enteDestino)->nombre ?? '-' }}</td>
                        @if (isset($movimiento->departamentoOrigen))
                        <td>{{ optional($movimiento->departamentoOrigen)->nombre ?? '-' }}</td>
                        @endif
                        <td>{{ optional($movimiento->departamentoDestino)->nombre ?? '-' }}</td>
                        <td>{{ $movimiento->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>





    </div>
</body>

</html>
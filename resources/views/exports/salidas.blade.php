 <table>
        <thead>
            <tr>
                <th><img src="{{ public_path('imagenes/cintillo.jpg') }}" height="80"></th>

            </tr>
            <tr>
                <th style="text-align: center !important">
                    <h1>REPORTE DE INVENTARIO</h1>
                </th>

            </tr>
        </thead>
    </table>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Ente Origen</th>
            <th>Ente Destino</th>
            <th>Departamento Origen</th>
            <th>Departamento Destino</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
        <tr>
            <td>{{ $item['Fecha'] }}</td>
            <td>{{ $item['Descripción'] }}</td>
            <td>{{ number_format($item['Monto'], 2, ',', '.') }}</td>
            <td>{{ $item['Ente Origen'] }}</td>
            <td>{{ $item['Ente Destino'] }}</td>
            <td>{{ $item['Departamento Origen'] }}</td>
            <td>{{ $item['Departamento Destino'] }}</td>
            <td>{{ $item['Usuario'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

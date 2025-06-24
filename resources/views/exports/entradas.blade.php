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
            <th>Factura</th>
            <th>Monto</th>
            <th>Ente</th>
            <th>Departamento</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $item)
        <tr>
            <td>{{ $item['Fecha'] }}</td>
            <td>{{ $item['Descripción'] }}</td>
            <td>{{ $item['Factura'] }}</td>
            <td>{{ number_format($item['Monto'], 2, ',', '.') }}</td>
            <td>{{ $item['Ente'] }}</td>
            <td>{{ $item['Departamento'] }}</td>
            <td>{{ $item['Usuario'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

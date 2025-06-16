<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
   
</head>
<body>

    <div class="cintillo">
        
    </div>

  
    <table>
          <thead>
            <tr>
                <th><img src="{{ public_path('imagenes/cintillo.jpg') }}" height="80"></th>
               
            </tr>
              <tr>
                 <th style="text-align: center !important"><h1>REPORTE DE INVENTARIO</h1></th>
               
            </tr>
        </thead>
    </table>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Bien</th>
                <th>Categoría</th>
                <th>Adquisición</th>
                <th>Estado</th>
                <th>Departamento</th>
                <th>Ente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bienes as $item)
                <tr>
                    <td>{{ $item->codigo_inventario }}</td>
                    <td>{{ $item->bien->nombre ?? '' }}</td>
                    <td>{{ $item->bien->categoria->nombre ?? '' }}</td>
                    <td>{{ $item->movimiento->fecha ?? '' }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>{{ $item->departamento->nombre ?? '' }}</td>
                    <td>{{ $item->ente->nombre ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

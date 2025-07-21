@extends('layouts.app')

@section('content')
  <div class="page">
    <!-- Sidebar -->


    <div class="page-wrapper pb-4 mb-4">
    <div class="page-header d-print-none">
      <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
        <h1 class="page-title">Bienvenido a Sistema IPASME</h1>
        </div>
      </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Bienes Disponibles</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">


            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">

            <div class="card-text-number mb-3">
            <h2>{{$bienes}}</h2>
            </div>
            <img src="imagenes/inventario.png" alt="Orden Icon" class="mb-3 mt-3"
            style="width: 70px; height: 70px;">
          </div>


          </div>

        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Entradas</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">


            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">
            <h2>{{$entradas}}</h2>
            </div>
            <img src="imagenes/entradas.png" alt="Orden Icon" class="mb-3 mt-3"
            style="width: 70px; height: 70px;">
          </div>


          </div>

        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Salidas</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">


            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">
            <h2>{{ $salidas }}</h2>
            </div>
            <img src="imagenes/salidas.png" alt="Orden Icon" class="mb-3 mt-3" style="width: 70px; height: 70px;">
          </div>


          </div>

        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Departamentos</div>
            <div class="ms-auto lh-1">

            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">
            <h2>{{$departamentos}}</h2>
            </div>
            <img src="imagenes/departamentos.png" alt="Orden Icon" class="mb-3 mt-3"
            style="width: 70px; height: 70px;">
          </div>




          </div>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="row row-cards">
          <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Bienes Desaparecidos</div>
              <div class="ms-auto lh-1">

              </div>
            </div>
            <div class="card-text-number mb-3">
              <h2>{{ $desaparecidos }}</h2>
            </div>


            </div>
          </div>
          </div>
          <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Bienes Descartados</div>
              <div class="ms-auto lh-1">

              </div>
            </div>
            <div class="card-text-number mb-3">
              <h2>{{ $descartados }}</h2>
            </div>


            </div>
          </div>
          </div>
          <div class="col-12 pb-4 mb-4">
          <div class="card">
            <div class="card-body" style="height: 10rem">
       <h5>Bienes con Bajo Stock</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Bien</th>
            <th>Departamento</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bienesBajoStock as $item)
            <tr>
                <td>{{ $item->bien->nombre }}</td>
                <td>{{ $item->departamento->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Sin bienes con bajo stock</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $bienesBajoStock->links() }}


            </div>
          </div>
          </div>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="col-lg-12">
          <div class="card">
          <div class="card-header border-0">
            <div class="card-title">Relación Entradas-Salidas</div>
          </div>
          <div class="position-relative">
            <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
            <div class="row g-2">
              <div class="col-auto">
              </div>

            </div>
            </div>
            <div id="graficoEntradasSalidas"></div>
          </div>

          </div>
        </div>
        </div>






      </div>
      </div>
    </div>
    </div>
  </div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const meses = [
      "Ene", "Feb", "Mar", "Abr", "May", "Jun",
      "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"
    ];

    const data = @json($meses);

    const entradas = data.map(d => d.entradas);
    const salidas = data.map(d => d.salidas);

    new ApexCharts(document.querySelector("#graficoEntradasSalidas"), {
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      series: [{
        name: 'Entradas',
        data: entradas
      }, {
        name: 'Salidas',
        data: salidas
      }],
      xaxis: {
        categories: meses
      },
      colors: ['#00b894', '#d63031'],
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: val => `${val} movimientos`
        }
      }
    }).render();
  });
</script>
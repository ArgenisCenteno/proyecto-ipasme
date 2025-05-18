@extends('layouts.app')

@section('content')
  <div class="page">
    <!-- Sidebar -->


    <div class="page-wrapper">
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
            <div class="subheader">Ordenes de Pago</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">
              <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Últimos 7 días</a>
              <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item active" href="#">Últimos 7 días</a>
              <a class="dropdown-item" href="#">Últimos 30 días</a>
              <a class="dropdown-item" href="#">Últimos 3 meses</a>
              </div>
            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">75</div>
            <img src="imagenes/orden.png" alt="Orden Icon" class="mb-3 mt-3" style="width: 70px; height: 70px;">
          </div>


          </div>

        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Salidas de Inventario</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">
              <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Últimos 7 días</a>
              <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item active" href="#">Últimos 7 días</a>
              <a class="dropdown-item" href="#">Últimos 30 días</a>
              <a class="dropdown-item" href="#">Últimos 3 meses</a>
              </div>
            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">75</div>
            <img src="imagenes/producto.png" alt="Orden Icon" class="mb-3 mt-3" style="width: 70px; height: 70px;">
          </div>


          </div>

        </div>
        </div>
        <div class="col-sm-6 col-lg-3">
        <div class="card">
          <div class="card-body">
          <div class="d-flex align-items-center">
            <!-- Add the image icon -->
            <div class="subheader">Pagos</div>
            <div class="ms-auto lh-1">
            <div class="dropdown">
              <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">Últimos 7 días</a>
              <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item active" href="#">Últimos 7 días</a>
              <a class="dropdown-item" href="#">Últimos 30 días</a>
              <a class="dropdown-item" href="#">Últimos 3 meses</a>
              </div>
            </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div class="card-text-number mb-3">75</div>
            <img src="imagenes/pago.png" alt="Orden Icon" class="mb-3 mt-3" style="width: 70px; height: 70px;">
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
            <div class="card-text-number mb-3">75</div>
            <img src="imagenes/departamentos.png" alt="Orden Icon" class="mb-3 mt-3" style="width: 70px; height: 70px;">
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
              <div class="subheader">Presupuesto</div>
              <div class="ms-auto lh-1">

              </div>
            </div>
            <div class="card-text-number mb-3">350,562.00</div>


            </div>
          </div>
          </div>
          <div class="col-12">
          <div class="card">
            <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="subheader">Causado</div>
              <div class="ms-auto lh-1">

              </div>
            </div>
            <div class="card-text-number mb-3">150,235.00</div>


            </div>
          </div>
          </div>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="col-lg-12">
          <div class="card">
          <div class="card-header border-0">
            <div class="card-title">Causado Mensual</div>
          </div>
          <div class="position-relative">
            <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
            <div class="row g-2">
              <div class="col-auto">
              </div>

            </div>
            </div>
            <div id="chart-development-activity"></div>
          </div>

          </div>
        </div>
        </div>
        <div class="col-12">
        <div class="card">
          <div class="card-body" style="height: 10rem"></div>
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
    window.ApexCharts &&
      new ApexCharts(document.getElementById("sparkline-activity"), {
        chart: {
          type: "radialBar",
          fontFamily: "inherit",
          height: 40,
          width: 40,
          animations: {
            enabled: false,
          },
          sparkline: {
            enabled: true,
          },
        },
        tooltip: {
          enabled: false,
        },
        plotOptions: {
          radialBar: {
            hollow: {
              margin: 0,
              size: "75%",
            },
            track: {
              margin: 0,
            },
            dataLabels: {
              show: false,
            },
          },
        },
        colors: [tabler.getColor("blue")],
        series: [35],
      }).render();
  });
</script>
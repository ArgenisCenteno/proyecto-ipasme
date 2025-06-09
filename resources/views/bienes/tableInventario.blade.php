<div class="table-responsive">
    <table class="table table-hover" id="entes-table">
        <thead class="bg-light">
            <tr>

                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Unidad Medida</th>
                <th>Marca</th>
                <th>Módelo</th>
                <th>Serial</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


</div>
@include('layouts.datatables_css')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#entes-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('bienes.inventario') }}",
            dataType: 'json',
            type: "POST",

            columns: [
                { data: 'codigo_inventario', name: 'codigo_inventario' },
                { data: 'nombre', name: 'nombre' },

                { data: 'categoria', name: 'categoria' },
                { data: 'unidad_medida', name: 'unidad_medida' },
                  { data: 'modelo', name: 'modelo' },
                    { data: 'marca', name: 'marca' },
                      { data: 'serial', name: 'serial' },
                { data: 'estado', name: 'estado' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],

            order: [[0, 'desc']],
            language: {
                lengthMenu: "Mostrar _MENU_ Registros por Página",
                zeroRecords: "Sin resultados",
                info: "",
                infoEmpty: "No hay Registros Disponibles",
                infoFiltered: "Filtrado _TOTAL_ de _MAX_ Registros Totales",
                search: "Buscar",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            }
        });


    });
</script>
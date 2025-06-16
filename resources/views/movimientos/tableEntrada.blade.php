<div class="table-responsive">
    <table class="table table-hover" id="entes-table">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Departamento</th>
                <th>Proveedor</th> 
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
            ajax: "{{ route('movimientos.index') }}",
            dataType: 'json',
            type: "POST",

            columns: [
                { 
                    data: null,
                    name: 'numero',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'tipo', name: 'tipo' },
                { data: 'descripcion', name: 'descripcion' },
                { data: 'fecha', name: 'fecha' },
                { data: 'departamentoDestino', name: 'departamentoDestino' },
                { data: 'proveedor.razon_social', name: 'proveedor.razon_social' }, 
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
<div class="table-responsive">
    <table class="table table-hover" id="entes-table">
        <thead class="bg-light">
            <tr>
                <th>#</th>

                <th>Nombre</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Unidad Medida</th>

                <th>Acción</th>

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
            ajax: "{{ route('bienes.activos') }}",
            dataType: 'json',
            type: "POST",

            columns: [
                { data: 'id', name: 'id' },
                { data: 'nombre', name: 'nombre' },
                { data: 'codigo_inventario', name: 'codigo_inventario' },
                { data: 'categoria.nombre', name: 'categoria.nombre' },
                { data: 'unidad_medida', name: 'unidad_medida' },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `<button class="btn btn-sm btn-primary agregar-producto" 
                        data-id="${row.id}" 
                        data-nombre="${row.nombre}" 
                        data-codigo="${row.codigo_inventario}"
                        data-categoria="${row.categoria.nombre}" 
                        data-unidad="${row.unidad_medida}"
                         data-marca="${row.marca}"
                          data-modelo="${row.modelo}">
                        Agregar
                    </button>`;
                    }
                }

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
<script>
    let productosAgregados = [];

    function actualizarInputProductos() {
        let productos = [];

        $('#carrito-entradas tbody tr').each(function () {
            let id = $(this).data('id');
            let cantidad = $(this).find('.cantidad-input').val();
    let serial = $(this).find('.serial-input').val();

            console.log(cantidad, id);
            if (cantidad > 0) {
                productos.push({ id: id, cantidad: parseInt(cantidad), serial: serial });
            }
        });

        console.log(productos);
        $('#productos_json').val(JSON.stringify(productos));
    }

    $(document).on('click', '.agregar-producto', function () {
        let id = $(this).data('id');

        if (productosAgregados.includes(id)) {
            Swal.fire('Producto ya agregado', '', 'warning');
            return;
        }

        let nombre = $(this).data('nombre');
        let codigo = $(this).data('codigo');
        let categoria = $(this).data('categoria');
        let unidad = $(this).data('unidad');
        let modelo = $(this).data('modelo');
        let marca = $(this).data('marca');
        let html = `
            <tr data-id="${id}">
                <td>${nombre}</td>
                <td>${codigo}</td>
                <td>${categoria}</td>
                   <td>${unidad}</td>
                     <td>${marca}</td>
                  <td>${modelo}</td>
              
             
                <td>
                    <input type="text" class="form-control serial-input" required>
                </td>
                <td>
                    <input type="number" class="form-control cantidad-input" min="1" value="1">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm eliminar-producto">Eliminar</button>
                </td>
            </tr>
        `;

        $('#carrito-entradas tbody').append(html);
        productosAgregados.push(id);
        actualizarInputProductos();
    });

    $(document).on('click', '.eliminar-producto', function () {
        let row = $(this).closest('tr');
        let id = row.data('id');

        row.remove();
        productosAgregados = productosAgregados.filter(pid => pid !== id);
        actualizarInputProductos();
    });

    $(document).on('input', '.cantidad-input', function () {
        actualizarInputProductos();
    });
    $(document).on('input', '.serial-input', function () {
        actualizarInputProductos();
    });
</script>
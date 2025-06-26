<div class="table-responsive">
    <table class="table table-hover" id="bienes-disponibles-table">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    let tableBienes;

    $('#departamento_origen_id').change(function () {
        const departamentoId = $(this).val();

        if (departamentoId) {
            if ($.fn.DataTable.isDataTable('#bienes-disponibles-table')) {
                tableBienes.destroy();
            }

            tableBienes = $('#bienes-disponibles-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5, 
                ajax: {
                    url: "{{ route('bienes.disponibles') }}",
                    type: "POST",
                    data: {
                        departamento_origen_id: departamentoId,
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'bien.nombre', name: 'bien.nombre' },
                    { data: 'codigo_inventario', name: 'codigo_inventario' },
                    { data: 'categoria_nombre', name: 'categoria_nombre' },
                    { data: 'cantidad', name: 'cantidad' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
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
        }
    });
</script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script>
    $(document).on('input', '.cantidad-input', function () {
    const input = $(this);
    const row = input.closest('tr');
    const stock = parseInt(row.find('td').eq(3).text()); // columna unidad (stock)
    let valor = parseInt(input.val());

    if (valor > stock) {
        Swal.fire('Cantidad excede el stock disponible', '', 'warning');
        input.val(stock); // ajustar al máximo permitido
        valor = stock;
    }

    if (valor < 1 || isNaN(valor)) {
        input.val(1); // establecer mínimo válido
        valor = 1;
    }

    actualizarInputProductos();
});

    let productosAgregados = [];

    function actualizarInputProductos() {
        let productos = [];

        $('#carrito-entradas tbody tr').each(function () {
            let id = $(this).data('id');
            let cantidad = $(this).find('.cantidad-input').val();

            console.log(cantidad, id);
            if (cantidad > 0) {
                productos.push({ id: id, cantidad: parseInt(cantidad) });
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

         if (unidad <= 0) {
              Swal.fire('Sin stock suficiente', '', 'warning');
            return;
        }
        let html = `
            <tr data-id="${id}">
                <td>${nombre}</td>
                <td>${codigo}</td>
                <td>${categoria}</td>
                <td>${unidad}</td>
                <td>
                    <input type="number"  class="form-control cantidad-input" min="1" value="1">
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
</script>
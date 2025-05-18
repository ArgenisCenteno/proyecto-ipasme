<form action="{{ route('movimientos.store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- Ente -->
        <div class="col-md-6 mb-3">
            <label for="ente_id" class="form-label">Ente <span class="text-danger">*</span></label>
            <select name="ente_id" id="ente_id" class="form-select @error('ente_id') is-invalid @enderror" required>
                <option value="">Seleccione un ente</option>
                @foreach ($entes as $id => $nombre)
                    <option value="{{ $id }}" {{ old('ente_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('ente_id') {{ $message }} @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="ente_id" class="form-label">Departamento <span class="text-danger">*</span></label>
            <select name="departamento_destino_id" id="departamento_destino_id"
                class="form-select @error('departamento_destino_id') is-invalid @enderror" required>
                <option value="">Seleccione un departamento</option>
            </select>

            <div class="invalid-feedback">
                @error('departamento_destino_id') {{ $message }} @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="proveedor_id" class="form-label">Proveedor <span class="text-danger">*</span></label>
            <select name="proveedor_id" id="proveedor_id"
                class="form-select @error('proveedor_id') is-invalid @enderror" required>
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedores as $id => $razon_social)
                    <option value="{{ $id }}" {{ old('proveedor_id') == $id ? 'selected' : '' }}>{{ $razon_social }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('proveedor_id') {{ $message }} @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            
        </div>


        <!-- Fecha -->
        <div class="col-md-4 mb-3">
            <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
            <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                value="{{ old('fecha') }}" required>
            <div class="invalid-feedback">
                @error('fecha') {{ $message }} @enderror
            </div>
        </div>
        <!-- Factura -->
        <div class="col-md-4 mb-3">
            <label for="factura" class="form-label">Factura</label>
            <input type="text" name="factura" id="factura" class="form-control @error('factura') is-invalid @enderror"
                value="{{ old('factura') }}">
            <div class="invalid-feedback">
                @error('factura') {{ $message }} @enderror
            </div>
        </div>

        <!-- Monto -->
        <div class="col-md-4 mb-3">
            <label for="monto" class="form-label">Monto <span class="text-danger">*</span></label>
            <input type="number" step="0.01" name="monto" id="monto"
                class="form-control @error('monto') is-invalid @enderror" value="{{ old('monto') }}" required>
            <div class="invalid-feedback">
                @error('monto') {{ $message }} @enderror
            </div>
        </div>
        <!-- Descripción -->
        <div class="col-md-12 mb-3">
            <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
            <textarea type="text" name="descripcion" id="descripcion"
                class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion') }}"
                required></textarea>
            <div class="invalid-feedback">
                @error('descripcion') {{ $message }} @enderror
            </div>
        </div>

        <!-- Observación -->
        <div class="col-md-12 mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea type="text" name="observacion" id="observacion"
                class="form-control @error('observacion') is-invalid @enderror"
                value="{{ old('observacion') }}"></textarea>
            <div class="invalid-feedback">
                @error('observacion') {{ $message }} @enderror
            </div>
        </div>

        <!-- Proveedor -->

    </div>

    <input type="hidden" name="productos_json" id="productos_json">

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('movimientos.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Registrar</button>
    </div>
</form>

<script>
    document.getElementById('ente_id').addEventListener('change', function () {
        const enteId = this.value;
        const departamentoSelect = document.getElementById('departamento_destino_id');

        // Vaciar el select de departamentos
        departamentoSelect.innerHTML = '<option value="">Cargando...</option>';

        if (enteId) {
            fetch(`/departamentos-data/${enteId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Seleccione un departamento</option>';
                    for (const [id, nombre] of Object.entries(data)) {
                        options += `<option value="${id}">${nombre}</option>`;
                    }
                    departamentoSelect.innerHTML = options;
                })
                .catch(() => {
                    departamentoSelect.innerHTML = '<option value="">Error al cargar departamentos</option>';
                });
        } else {
            departamentoSelect.innerHTML = '<option value="">Seleccione un ente primero</option>';
        }
    });
</script>
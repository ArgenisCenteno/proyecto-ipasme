<form action="{{ route('salidas.store') }}" method="POST">
    @csrf

    <div class="row">

        <!-- Ente Origen -->
        <div class="col-md-6 mb-3">
            <label for="ente_origen_id" class="form-label">Ente Origen <span class="text-danger">*</span></label>
            <select name="ente_origen_id" id="ente_origen_id" class="form-select" required>
                <option value="">Seleccione un ente</option>
                @foreach ($entes as $id => $nombre)
                    <option value="{{ $id }}" {{ old('ente_origen_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
             <div class="invalid-feedback">
                @error('ente_origen_id') {{ $message }} @enderror
            </div>
        </div>

        <!-- Departamento Origen -->
        <div class="col-md-6 mb-3">
            <label for="departamento_origen_id" class="form-label">Departamento Origen <span class="text-danger">*</span></label>
            <select name="departamento_origen_id" id="departamento_origen_id" class="form-select" required>
                <option value="">Seleccione un ente primero</option>
            </select>
             <div class="invalid-feedback">
                @error('departamento_origen_id') {{ $message }} @enderror
            </div>
        </div>

        <!-- Ente Destino -->
        <div class="col-md-6 mb-3">
            <label for="ente_destino_id" class="form-label">Ente Destino <span class="text-danger">*</span></label>
            <select name="ente_destino_id" id="ente_destino_id" class="form-select" required>
                <option value="">Seleccione un ente</option>
                @foreach ($entes as $id => $nombre)
                    <option value="{{ $id }}" {{ old('ente_destino_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
             <div class="invalid-feedback">
                @error('ente_destino_id') {{ $message }} @enderror
            </div>
        </div>

        <!-- Departamento Destino -->
        <div class="col-md-6 mb-3">
            <label for="departamento_destino_id" class="form-label">Departamento Destino <span class="text-danger">*</span></label>
            <select name="departamento_destino_id" id="departamento_destino_id" class="form-select" required>
                <option value="">Seleccione un ente primero</option>
            </select>
             <div class="invalid-feedback">
                @error('departamento_destino_id') {{ $message }} @enderror
            </div>
        </div>

        <!-- Fecha -->
        <div class="col-md-6 mb-3">
            <label for="fecha" class="form-label">Fecha <span class="text-danger">*</span></label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required>
        </div>

        <!-- Monto (nullable) -->
        <div class="col-md-6 mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" step="any" name="monto" id="monto" class="form-control" value="{{ old('monto') }}">
        </div>

        <!-- Descripción -->
        <div class="col-md-12 mb-3">
            <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
        </div>

        <!-- Observación -->
        <div class="col-md-12 mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea name="observacion" id="observacion" class="form-control">{{ old('observacion') }}</textarea>
        </div>

        <input type="hidden" name="productos_json" id="productos_json">

        <div class="btn-list d-flex justify-content-end">
            <a href="{{ route('movimientos.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary" id="btn-submit">Registrar</button>
        </div>
    </div>
</form>


<script>
    function cargarDepartamentos(enteId, departamentoSelectId) {
        const departamentoSelect = document.getElementById(departamentoSelectId);
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
                    departamentoSelect.innerHTML = '<option value="">Error al cargar</option>';
                });
        } else {
            departamentoSelect.innerHTML = '<option value="">Seleccione un ente primero</option>';
        }
    }

    document.getElementById('ente_origen_id').addEventListener('change', function () {
        cargarDepartamentos(this.value, 'departamento_origen_id');
    });

    document.getElementById('ente_destino_id').addEventListener('change', function () {
        cargarDepartamentos(this.value, 'departamento_destino_id');
    });
</script>
<script>
    document.getElementById('btn-submit').addEventListener('click', function (e) {
        const deptoOrigen = document.getElementById('departamento_origen_id')?.value;
        const deptoDestino = document.getElementById('departamento_destino_id')?.value;

       // console.log(deptoOrigen && deptoDestino && deptoOrigen == deptoDestino)
        // Verificar que los valores existan y sean iguales
        if (deptoOrigen && deptoDestino && deptoOrigen == deptoDestino) {
            e.preventDefault(); // Evita el envío del formulario

            const destinoSelect = document.getElementById('departamento_destino_id');
            destinoSelect.classList.add('is-invalid');

            const feedback = destinoSelect.parentElement.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = 'El departamento de destino no puede ser el mismo que el de origen.';
            } else {
                const div = document.createElement('div');
                div.className = 'invalid-feedback';
                div.textContent = 'El departamento de destino no puede ser el mismo que el de origen.';
                destinoSelect.parentElement.appendChild(div);
            }

            return false;
        }
    });
</script>

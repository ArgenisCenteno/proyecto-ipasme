<form action="{{ route('salidas.store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- Ente Origen (Oculto) -->
        <input type="hidden" name="ente_origen_id" value="{{ $entes->id }}">

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

        <!-- Ente Destino (Oculto) -->
        <input type="hidden" name="ente_destino_id" value="{{ $entes->id }}">

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
    const enteUnicoId = "{{ $entes->id }}";

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

    document.addEventListener('DOMContentLoaded', function () {
        // Cargar departamentos automáticamente ya que el ente es único
        cargarDepartamentos(enteUnicoId, 'departamento_origen_id');
        cargarDepartamentos(enteUnicoId, 'departamento_destino_id');

        // Validación: origen y destino no deben ser iguales
        document.getElementById('btn-submit').addEventListener('click', function (e) {
            const deptoOrigen = document.getElementById('departamento_origen_id')?.value;
            const deptoDestino = document.getElementById('departamento_destino_id')?.value;

            if (deptoOrigen && deptoDestino && deptoOrigen == deptoDestino) {
                e.preventDefault();

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

        // Validar que la fecha no sea futura
        const today = new Date().toISOString().split('T')[0];
        const fechaInput = document.getElementById('fecha');
        fechaInput.setAttribute('max', today);

        fechaInput.addEventListener('change', function () {
            if (this.value > today) {
                this.value = '';
                alert('La fecha no puede ser posterior a hoy.');
            }
        });
    });
</script>

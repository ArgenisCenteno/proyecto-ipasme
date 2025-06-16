<form action="{{ route('departamentos.store') }}" method="POST">
    @csrf

    <div class="row">
        <!-- Nombre -->
        <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre" id="nombre" class="only-text form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
            <div class="invalid-feedback">
                @error('nombre')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Descripción -->
        <div class="col-md-6 mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" class="only-text form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
            <div class="invalid-feedback">
                @error('descripcion')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Encargado -->
        <div class="col-md-6 mb-3">
            <label for="encargado" class="form-label">Encargado</label>
            <input type="text" name="encargado" id="encargado" class="only-text form-control @error('encargado') is-invalid @enderror" value="{{ old('encargado') }}">
            <div class="invalid-feedback">
                @error('encargado')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <!-- Estado -->
        

        <!-- Ente -->
        <div class="col-md-6 mb-3">
           <input type="hidden" name="ente_id" value="{{ $entes->id }}">
            <input type="hidden" name="estado" value="1">
        </div>
    </div>

    <div class="btn-list d-flex justify-content-end">
        <a href="{{ route('departamentos.index') }}" class="btn btn-danger">Cancelar</a>
        <button type="submit" class="btn btn-primary" id="btn-submit">Registrar</button>
    </div>
</form>

<form action="{{ route('clientes.update', $cliente) }}" method="post">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text" class="form-control my-colorpicker1"
                    value="{{ old('nombre', $cliente->nombre) }}" required>

                @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input name="apellido" type="text" class="form-control my-colorpicker1"
                    value="{{ old('apellido', $cliente->apellido) }}" required>

                @error('apellido')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="ci">Carnet de identidad</label>
                <input name="ci" type="text" class="form-control my-colorpicker1"
                    value="{{ old('ci', $cliente->ci) }}" required>

                @error('ci')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input name="telefono" type="text" class="form-control my-colorpicker1"
                    value="{{ old('telefono', $cliente->telefono) }}">

                @error('telefono')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="puntos">Puntos acumulados</label>
                <input name="puntos" type="text" class="form-control my-colorpicker1"
                    value="{{ old('puntos', $cliente->puntos) }}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control select2" style="width: 100%;">
                    <option value="1" {{ $cliente->estado ? 'selected' : '' }}>Activo
                    </option>
                    <option value="0" {{ $cliente->estado ? '' : 'selected' }}>Inactivo
                    </option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row-reverse">
        <button type="submit" class="btn btn-info">Guardar</button>
        <a type="button" class="btn btn-danger mx-2"
            href="{{ url()->previous() }}">Cancelar</a>
    </div>
</form>
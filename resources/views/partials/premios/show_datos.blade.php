<div class="row">
    <div class="col-md-3">
        <label>Nombre</label>
        <p class="form-control my-colorpicker1">{{ $premio->nombre }}</p>
    </div>
    <div class="col-md-3">
        <label>Puntos requeridos</label>
        <p class="form-control my-colorpicker1">{{ $premio->puntos_requeridos }}</p>
    </div>
    <div class="col-md-3">
        <label>Stock</label>
        <p class="form-control my-colorpicker1">{{ $premio->stock }}</p>
    </div>
    <div class="col-md-3">
        <label>Estado</label>
        <p class="form-control">{{ $premio->estado ? 'Activo' : 'Inactivo' }}</p>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <label>Descripción</label>
        <p name="descripcion" class="border rounded p-2">
            {{ $premio->descripcion }}
        </p>
    </div>

    <div class="col-md-6">
        <label>Producto</label>
        <div class="input-group">
            <p class="form-control" style="width: 50%">
                {{ is_null($premio->producto_id) ? 'Sin producto' : $premio->producto->nombre }}
            </p>
            <div class="input-group-prepend">
                <span class="input-group-text" id="">uds.</span>
            </div>
            <p class="form-control">{{ $premio->unidades_producto }}</p>
        </div>
    </div>
</div>
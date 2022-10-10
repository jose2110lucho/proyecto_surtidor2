@extends('layouts/master')

@section('content_header')
<h1>Producto</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ route('producto.store') }}">
            @csrf
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca nombre del producto">
            </div>
            <!--fin campo nombre-->
            <!--inicio campo precio_compra-->
            <div class="mb-3">
                <label for="precio_compra" class="form-label">precio de compra</label>
                <input name="precio_compra" type="number" class="form-control" id="precio_compra" placeholder="introduzca el precio de compra">
            </div>
            <!--fin campo precio_compra-->
            <!--inicio campo precio_venta-->
            <div class="mb-3">
                <label for="precio_venta" class="form-label">precio de venta</label>
                <input name="precio_venta" type="number" class="form-control" id="precio_venta" placeholder="introduzca el precio de venta">
            </div>
            <!--fin campo precio_venta-->
            <!--inicio campo botones-->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">guardar</button>
                <a href="{{ url('/producto') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
            <!--fin campo botones-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
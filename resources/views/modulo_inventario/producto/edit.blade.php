@extends('layouts/master')

@section('content_header')
<h1> Editar Producto : {{ $producto->name }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ url('/producto/' . $producto->id) }}">
            @csrf
            {{ method_field('PUT') }}
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" 
                required value="{{ $producto->nombre }}">
            </div>
            <!--fin campo nombre-->
            <!--inicio campo precio_compra-->
            <div class="mb-3">
                <label for="precio_compra" class="form-label">precio de compra</label>
                <input name="precio_compra" type="number" class="form-control" id="precio_compra" 
                required value="{{ $producto->precio_compra }}">
            </div>
            <!--fin campo precio_compra-->
            <!--inicio campo precio_venta-->
            <div class="mb-3">
                <label for="precio_venta" class="form-label">precio de venta</label>
                <input name="precio_venta" type="number" class="form-control" id="precio_venta" 
                required value="{{ $producto->precio_venta }}">
            </div>
            <!--fin campo precio_venta-->
            <!--inicio campo boton-->
            <div class="row mb-0">
               
                    <div class="col-md-10 offset-md-2">
                        <input type="submit" value="Guardar Datos" class="btn btn-success">
                        <a href="{{ url('/producto') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div> 
                 
            </div>          
            <!--fin campo boton-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
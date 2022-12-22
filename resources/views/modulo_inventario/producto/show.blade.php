@extends('adminlte::page')

@section('content_header')
    <h1> Producto : {{ $producto->nombre }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!--aqui empieza el codigo del formulario-->
            <form method="POST" action="{{ url('/producto/' . $producto->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <!--inicio campo nombre-->

                <div class="col-sm-4 mx-auto">
                    <div class="d-flex">
                        <div class="card border-1 shadow">
                            <img src="{{$image}}"
                                alt="foto de perfil del usuario" height="160">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">nombre</label>
                    <p type="text" class="form-control">{{ $producto->nombre }}</p>
                </div>
                <!--fin campo nombre-->
                <!--inicio campo precio_compra-->
                <div class="mb-3">
                    <label for="precio_compra" class="form-label">precio de compra</label>
                    <p type="text" class="form-control">{{ $producto->precio_compra }}</p>
                </div>
                <!--fin campo precio_compra-->
                <!--inicio campo precio_venta-->
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">precio de venta</label>
                    <p type="text" class="form-control">{{ $producto->precio_venta }}</p>
                </div>
                <!--fin campo precio_venta-->
                <!--inicio campo cantidad-->
                <div class="mb-3">
                    <label for="cantidad" class="form-label">cantidad</label>
                    <p type="text" class="form-control">{{ $producto->cantidad }}</p>
                </div>
                <!--fin campo cantidad-->
                <!--inicio campo estado-->
                <div class="form-group">
                    <label for="estado">estado</label>
                    <p type="text" class="form-control my-colorpicker1">
                        {{ $producto->estado ? 'Disponible' : 'No Disponible' }}</p>
                </div>
                <!--inicio campo estado-->
                <!--inicio campo descripcion-->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">descripcion</label>
                    <p type="text" class="form-control">{{ $producto->descripcion }}</p>
                </div>
                <!--fin campo descripcion-->
                <!--inicio campo imagen-->
                <div>
                    <img src="{{ asset($producto->imagen) }}" alt="" class="img-fluid img-thumbnail"
                        width="80px">
                </div>
                <!--fin campo imagen-->
                <!--inicio campo boton-->
                <div class="row mb-0">
                    <div class="col-md-10 offset-md-2">
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

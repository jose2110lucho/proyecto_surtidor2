@extends('layouts/master')

@section('content_header')
<h1> Nota de compra :{{$nota_producto->id}}  </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card" style="background:cornsilk">
            <div class="card-body">
            <!--inicio campo nombre del proveedor-->
            <div class="mb-3">
                <label for="proveedor" class="form-label">proveedor</label>
                <p type="text" class="form-control">{{ $nota_producto->nombre }}</p>
            </div>
            <!--fin campo nombre del proveedor-->
            <!--inicio campo fecha-->
            <div class="mb-3">
                <label for="fecha" class="form-label">fecha</label>
                <p type="date" class="form-control">{{ $nota_producto->fecha }}</p>
            </div>
            <!--fin campo fecha-->
            </div>
          </div>
        <div class="card" style="background:cornsilk">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <table class="table caption-top">
                            <caption></caption>
                            <thead class="table-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lista_productos as $producto)
                                <tr>
                                    <td>{{$producto->producto_id}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->precio_compra}}</td>
                                    <td>{{$producto->cantidad*$producto->precio_compra}}</td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                </div> 
            </div>
          </div>
        <!--inicio campo total-->
        <div class="mb-3">
            <label for="total" class="form-label">total</label>
            <p type="number" class="form-control">{{ $nota_producto->total }}</p>
        </div>
        <!--fin campo total-->
        <!--inicio campo botones-->
        <div class="row mb-0" style="text-align:right">
            <div class="col-md-10 offset-md-2">
                <a href="{{ url('/nota_producto') }}" class="btn btn-success">
                    Atras
                </a>
            </div> 
        </div>          
    <!--fin campo botones-->
    </div>
</div>
@stop
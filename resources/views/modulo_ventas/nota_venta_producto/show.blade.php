@extends('layouts/master')

@section('content_header')
<h1> Nota de venta :{{$nota_venta_producto->id}}  </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card" style="background:cornsilk">
            <div class="card-body">
            <!--inicio campo nombre del cliente-->
            <div class="mb-3">
                <label for="cliente" class="form-label">cliente</label>
                <p type="text" class="form-control">{{ $nota_venta_producto->nombre }}</p>
            </div>
            <!--fin campo nombre del cliente-->
            <!--inicio campo fecha-->
            <div class="mb-3">
                <label for="fecha" class="form-label">fecha</label>
                <p type="date" class="form-control">{{ $nota_venta_producto->fecha }}</p>
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
                                    <td>{{$producto->precio_venta}}</td>
                                    <td>{{$producto->cantidad*$producto->precio_venta}}</td>
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
            <p type="number" class="form-control">{{ $nota_venta_producto->total }}</p>
        </div>
        <!--fin campo total-->
        <!--inicio campo botones-->
        <div class="row mb-0" style="text-align:right">
            <div class="col-md-10 offset-md-2">
                <a href="{{ url('/nota_venta_producto') }}" class="btn btn-warning">
                    Atras
                </a>
            </div> 
        </div>  

        @if($existeFactura)

            <div class="row mb-0" style="text-align:right">
                <div class="col-md-10 offset-md-2">
                    <a href="{{ route('factura_producto.generateInvoice',[$nota_venta_producto->id]) }}" class="btn btn-warning">
                        Ver Factura
                    </a>
                </div> 
            </div>

        @else
        
            <div class="row mb-0" style="text-align:right">
                <div class="col-md-10 offset-md-2">
                    <a href="{{ route('factura_producto.create',[$nota_venta_producto->id]) }}" class="btn btn-warning">
                        siguiente
                    </a>
                </div> 
            </div>
            
        @endif 


        


        
        
    <!--fin campo botones-->
    </div>
</div>
@stop
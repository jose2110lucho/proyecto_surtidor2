@extends('layouts/master')

@section('content_header')

@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <h1 style="font-weight: bolder"> NOTA DE VENTA</h1>
    <label for="Nro" class="d-flex justify-content-end" style="font-size: x-large">Nro: {{$nota_venta_combustible->id}}</label> 
    <label for="fecha" class="d-flex justify-content-end" style="font-size: x-large">fecha: {{ $nota_venta_combustible->fecha }}</label>  
    </div>
    <div class="card-body">
    <!--inicio campo nombre del cliente-->
    <ul class="list-group" style="text-align:left">
        <li class="list-group-item" style="font-size: x-large"> <strong>Nombre del cliente:</strong> {{ $nota_venta_combustible->vehiculo->cliente->nombre }} {{ $nota_venta_combustible->vehiculo->cliente->apellido }}</li>
        <li class="list-group-item" style="font-size: x-large"><strong>CI del cliente:</strong> {{ $nota_venta_combustible->vehiculo->cliente->ci }}</li>
        <li class="list-group-item" style="font-size: x-large"> <strong>Telefono del cliente:</strong> {{ $nota_venta_combustible->vehiculo->cliente->telefono }}</li>
        <li class="list-group-item" style="font-size: x-large"><strong>Vendedor:</strong> {{ $nota_venta_combustible->userBombas->user->name }}</li>
        <li class="list-group-item" style="font-size: x-large"><strong>Bomba:</strong> {{ $nota_venta_combustible->userBombas->bomba->nombre }}</li>
        <li class="list-group-item" style="font-size: x-large"><strong>Tanque:</strong> {{ $nota_venta_combustible->userBombas->bomba->tanque->descripcion }}</li>
      </ul>
    <!--fin campo nombre del cliente-->
    </div>
    <!-- incio seccion de detalle de la nota de venta -->
    <div class="card-footer text-muted">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <table class="table caption-top">
                            <caption></caption>
                            <thead class="table-white bg-orange">
                                <tr>
                                    <th scope="col"><h4><strong>#</strong></h4></th>
                                    <th scope="col"><h4><strong>Combustible</strong></h4></th>
                                    <th scope="col"><h4><strong>Cantidad(Lts)</strong></h4></th>
                                    <th scope="col"><h4><strong>Precio(Bs)</strong></h4></th>
                                    <th scope="col"><h4><strong>Total(Bs)</strong></h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><h4>{{$combustible->id}}</h4></td>
                                    <td><h4>{{$combustible->nombre}}</h4></td>
                                    <td><h4>{{$nota_venta_combustible->cantidad_combustible}}</h4></td>
                                    <td><h4>{{$combustible->precio_venta}}</h4></td>
                                    <td><h4>{{$nota_venta_combustible->total}}</h4></td>
                                </tr> 
                            </tbody>
                        </table>
                    </table>
                </div> 
            </div>
          </div>
        <div class="d-flex justify-content-end">
            <a type="button" class="btn btn-warning" href="{{ url('/nota_venta_combustible') }}" style="margin:5px">
                Atras 
            </a>
                <div>                   
                    @if($existeFactura)
                                    <a type="button" class="btn btn-primary" href="{{ route('factura_combustible.generateInvoice',[$nota_venta_combustible->id]) }}" style="margin:5px">
                                        Ver Factura
                                    </a>                
                    @else
                                    <a type="button" class="btn btn-success" href="{{ route('factura_combustible.create',[$nota_venta_combustible->id]) }}" style="margin:5px">
                                        siguiente
                                    </a>  
                    @endif        
                </div>
        </div>
    </div>
@stop
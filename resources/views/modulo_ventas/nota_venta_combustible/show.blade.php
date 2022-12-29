@extends('layouts/master')

@section('content_header')
<h1> Nota de venta :{{$nota_venta_combustible->id}}  </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card" style="background:cornsilk">
            <div class="card-body">
            <!--inicio campo nombre del cliente-->
            <div class="mb-3">
                <label for="cliente" class="form-label">cliente</label>
                <p type="text" class="form-control">{{ $nota_venta_combustible->vehiculo->cliente->nombre }}</p>
            </div>
            <!--fin campo nombre del cliente-->
            <!--inicio campo nombre del vendedor-->
            <div class="mb-3">
                <label for="cliente" class="form-label">vendedor</label>
                <p type="text" class="form-control">{{ $nota_venta_combustible->userBombas->user->name }}</p>
            </div>
            <!--fin campo nombre del vendedor-->
            <!--inicio campo nombre del bomba-->
            <div class="mb-3">
                <label for="bomba" class="form-label">bomba</label>
                <p type="text" class="form-control">{{ $nota_venta_combustible->userBombas->bomba->nombre }}</p>
            </div>
            <!--fin campo nombre del bomba-->
            <!--inicio campo nombre del tanque-->
            <div class="mb-3">
                <label for="tanque" class="form-label">tanque</label>
                <p type="text" class="form-control">{{ $nota_venta_combustible->userBombas->bomba->tanque->descripcion }}</p>
            </div>
            <!--fin campo nombre del tanque-->
            <!--inicio campo fecha-->
            <div class="mb-3">
                <label for="fecha" class="form-label">fecha</label>
                <p type="date" class="form-control">{{ $nota_venta_combustible->fecha }}</p>
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
                                    <th scope="col">combustible</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$combustible->id}}</td>
                                    <td>{{$combustible->nombre}}</td>
                                    <td>{{$nota_venta_combustible->cantidad_combustible}}</td>
                                    <td>{{$combustible->precio_venta}}</td>
                                    <td>{{$nota_venta_combustible->total}}</td>
                                </tr> 
                            </tbody>
                        </table>
                    </table>
                </div> 
            </div>
          </div>
        
        <!--inicio campo botones-->
        <div class="row mb-0" style="text-align:right">
            <div class="col-md-10 offset-md-2">
                <a href="{{ url('/nota_venta_combustible') }}" class="btn btn-warning">
                    Atras
                </a>
            </div> 
        </div>     

               


    <!--fin campo botones-->
    </div>
</div>
@stop
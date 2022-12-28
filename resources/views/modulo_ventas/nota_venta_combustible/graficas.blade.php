@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col col-lg-6 col-sm-12">
                    @include('modulo_ventas.nota_venta_combustible.partials.grafica_monto_total')
                </div>
                <div class="col col-lg-6 col-sm-12">
                    @include('modulo_ventas.nota_venta_combustible.partials.grafica_monto_promedio')

                </div>
            </div>
        </div>
    </section>
@endsection

@section('plugins.Chartjs', true)

@section('js')
    @include('modulo_ventas.nota_venta_combustible.scripts.script_monto_total')
    @include('modulo_ventas.nota_venta_combustible.scripts.script_monto_promedio')
@endsection

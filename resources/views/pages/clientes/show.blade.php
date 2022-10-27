@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card card-cyan card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h4 class="my-auto ">
                                <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong>
                            </h4>
                            <p class="my-auto text-muted">
                                Cliente
                            </p>
                        </div>
                        <div class="col-xs-2 text-right">
                            <span class="fa fa-address-card fa-4x"></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted text-sm">
                    <div class="d-flex justify-content-between my-n2">
                        <p class="my-auto"><small>Registrado: {{ $cliente->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>

            </div>

            <div class="card card-cyan card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->any() ? '' : 'active' }}" id="datos_cliente_tab"
                                data-toggle="pill" href="#datos_cliente" role="tab"
                                aria-controls="datos_cliente">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->any() ? 'active' : '' }}" id="datos_cliente_edit_tab"
                                data-toggle="pill" href="#datos_cliente_edit" role="tab"
                                aria-controls="datos_cliente_edit">Editar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade {{ $errors->any() ? '' : 'show active' }}" id="datos_cliente"
                            role="tabpanel" aria-labelledby="datos_cliente_tab">
                            @include('partials.clientes.show_datos')
                        </div>

                        <div class="tab-pane fade {{ $errors->any() ? 'show active' : '' }}" id="datos_cliente_edit"
                            role="tabpanel" aria-labelledby="datos_cliente_edit_tab">
                            @include('partials.clientes.form_edit')
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Vehiculos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @include('partials.vehiculos.table_list')
                    </div>
                </div>
            </div>

            <div class="card card-purple">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4">
                            <h3 class="card-title mt-1">Premios</h3>
                            <a class="btn bg-gradient-danger btn-sm mx-4"
                                href="{{ route('clientes.canjeo', $cliente) }}">Canjear</a>
                        </div>
                        <div class="card-tools my-auto mx-n1">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @include('partials.clientes.table_premios')
                </div>
            </div>
    </section>
@stop

@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div >
                        <h4 class="px-3 pt-3">
                            <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong>
                        </h4>
                        <p class="px-3">
                            CLIENTE
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-address-card fa-4x"></span>
                    </div>
                </div>
            </div>
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title card-success">Datos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <p type="text" class="form-control my-colorpicker1">{{ $cliente->nombre }}</p>
                            </div>
                            <div class="form-group">
                                <label>Carnet de identidad</label>
                                <p type="text" class="form-control my-colorpicker1">{{ $cliente->ci }}</p>
                            </div>
                            <div class="form-group">
                                <label>Puntos acumulados</label>
                                <p type="text" class="form-control my-colorpicker1">{{ $cliente->puntos }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellido</label>
                                <p type="text" class="form-control my-colorpicker1">{{ $cliente->apellido }}</p>
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <p type="text" class="form-control my-colorpicker1">{{ $cliente->telefono }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <a type="button" class="btn btn-info" href="{{route('clientes.edit',$cliente)}}">Editar</a>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $cliente->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- SELECT2 EXAMPLE -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Vehiculos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@stop

@extends('adminlte::page')

@section('title', 'Lista de vehiculos')

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row g-2">
                        <div class="col-sm-6 p-2">
                            <h3 class="card-title">
                                <strong>LISTA DE VEHICULOS</strong>
                            </h3>
                        </div>
                        <div class="col-sm-3 text-right my-auto">
                            <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary"
                                type="button">Nuevo</button>
                        </div>

                        <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo vehiculo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- @include('partials.clientes.form_create') --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 my-auto">
                            <form action="{{ route('vehiculos.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="buscar" id="buscar" type="text" class="form-control"
                                        placeholder="placa, marca..." value="{{ old('buscar') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-default" type="submit">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 450;">
                    @include('partials.vehiculos.table_list')
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(window).on('load', function() {
            let a = 'hola'
            if ('{{ $errors->any() }}') {
                $('#formCreateModal').modal('show');
            }
        });
    </script>
@stop

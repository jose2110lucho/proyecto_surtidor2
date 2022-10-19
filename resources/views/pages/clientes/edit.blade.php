@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- card titulo -->
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div>
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
            <!--/card titulo-->
            <!-- card datos -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title card-success">Editar datos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input name="nombre" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('nombre', $cliente->nombre) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input name="apellido" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('apellido', $cliente->apellido) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ci">Carnet de identidad</label>
                                    <input name="ci" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('ci', $cliente->ci) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input name="telefono" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('telefono', $cliente->telefono) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="puntos">Puntos acumulados</label>
                                    <input name="number" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('puntos', $cliente->puntos) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-control select2" style="width: 100%;">
                                        <option value="1" {{ $cliente->estado ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="0" {{ $cliente->estado ? '' : 'selected' }}>Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a type="button" class="btn btn-danger mx-2"
                                href="{{ url()->previous() }}">Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /card-body -->
                <!-- card-footer -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $cliente->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>
                <!--/card-footer-->
            </div>
            <!-- /card datos -->
        </div>
    </section>
@stop

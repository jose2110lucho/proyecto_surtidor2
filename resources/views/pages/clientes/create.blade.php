@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="card-title px-3 py-3">
                            <strong>REGISTRAR NUEVO CLIENTE</strong>
                        </h3>
                    </div>
                </div>
            </div>
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title card-success">Datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('clientes.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input name="nombre" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('nombre') }}">

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ci">Carnet de identidad</label>
                                    <input name="ci" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('ci') }}">

                                    @error('ci')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="puntos">Puntos acumulados</label>
                                    <input name="number" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('puntos', 0) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input name="apellido" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('apellido') }}">

                                    @error('apellido')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input name="telefono" type="text" class="form-control my-colorpicker1"
                                        value="{{ old('telefono') }}">

                                    @error('telefono')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a type="button" class="btn btn-danger mx-2" href="">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@stop

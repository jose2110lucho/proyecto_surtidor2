@extends('adminlte::page')

@section('title', 'tanques')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>DATOS DEL TANQUE</strong>
                        </h4>
                        <form action="{{ route('tanques.destroy', $tanque) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2" onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('tanques.edit', $tanque) }}" class="btn btn-info px-2">
                                    <i class="fas fa-pen" aria-hidden="true">
                                    </i>
                                </a>


                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <p class="form-control my-colorpicker1">{{ $tanque->codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Combustible</label>
                                <p class="form-control my-colorpicker1">{{ $tanque->combustible }}</p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <p class="form-control my-colorpicker1">
                                    {{ $tanque->codigo ? 'Activo' : 'Inactivo' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <p class="border rounded p-2">{{ $tanque->descripcion }}</p>

                        <div class="py-1">
                            <hr />
                        </div>

                        <div class="row py-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cantidad disponible</label>
                                    <p class="form-control my-colorpicker1">{{ $tanque->cantidad_disponible }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cantidad mínima</label>
                                    <p class="form-control my-colorpicker1">{{ $tanque->cantidad_min }}</p>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Capacidad del tanque</label>
                                    <p class="form-control my-colorpicker1">
                                        {{ $tanque->capacidad_max }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="progress my-1" style="height: 2px;">
                                    <div class="progress-bar bg-cyan "
                                        style="width:{{ ($tanque->cantidad_min * 100) / $tanque->capacidad_max }}%;"></div>
                                </div>
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar text-left p-2 progress-bar-striped progress-bar-animated 
                                @if ($tanque->cantidad_disponible > $tanque->cantidad_min) bg-cyan
                                @else bg-red @endif"
                                        style="width: {{ ($tanque->cantidad_disponible / $tanque->capacidad_max) * 100 }}%">
                                        {{ 'Cantidad disponible: ' . $tanque->cantidad_disponible . ' lts' }}

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $tanque->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $tanque->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
@stop

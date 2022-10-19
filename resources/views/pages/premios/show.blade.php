@extends('adminlte::page')

@section('title', 'Informacion del premio')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>INFORMACIÓN DEL PREMIO</strong>
                        </h4>
                        <form action="{{ route('premios.destroy', $premio) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2"
                                    onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('premios.edit', $premio) }}" class="btn btn-info px-2">
                                    <i class="fas fa-pen" aria-hidden="true">
                                    </i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nombre">Nombre</label>
                            <p class="form-control my-colorpicker1">{{ $premio->nombre }}</p>
                        </div>
                        <div class="col-md-3">
                            <label for="unidades">Unidades</label>
                            <p class="form-control my-colorpicker1">{{ $premio->unidades }}</p>
                        </div>
                        <div class="col-md-3">
                            <label for="puntos_requeridos">Puntos requeridos</label>
                            <p class="form-control my-colorpicker1">{{ $premio->puntos_requeridos }}</p>
                        </div>
                        <div class="col-md-3">
                            <label for="estado">Estado</label>
                            <p class="form-control my-colorpicker1">{{ $premio->estado ? 'Activo' : 'Inactivo' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="descripcion">Descripción</label>
                            <p name="descripcion" class="border rounded p-2">
                                {{ $premio->descripcion }}
                            </p>
                        </div>
                        <div class="col-md-3">
                            <label for="producto">Producto</label>
                            <p name="producto" class="form-control my-colorpicker1">
                                {{ is_null($premio->producto_id) ? 'Sin producto' : $premio->producto->nombre}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <p class="my-auto"><small>Creado: {{ $premio->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $premio->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@extends('adminlte::page')

@section('title', 'vehiculos')

@section('plugins.Sweetalert2', true)

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>VEHICULO</strong>
                        </h4>
                        <div class="card-tools">
                            <div class="d-flex">
                                <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger "
                                        onclick="return confirm('¿Estas seguro?')">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-info">
                                        <i class="fas fa-pen" aria-hidden="true"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Placa</label>
                            <p class="form-control ">{{ $vehiculo->placa }}</p>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tipo</label>
                                <p class="form-control">
                                    {{ $vehiculo->tipo }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <p class="form-control">
                                    {{ $vehiculo->marca }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Color</label>
                            <p class="form-control">{{ $vehiculo->color }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label>Dueño</label>
                            <p class="form-control">{{ $vehiculo->placa }}</p>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>B-SISA</label>
                                <p class="form-control ">
                                    {{ $vehiculo->b_sisa ? 'Hábil' : 'Inhábil' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <p class="my-auto"><small>Creado: {{ $vehiculo->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $vehiculo->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

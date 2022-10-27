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
                            <strong>REGISTRAR VEHICULO</strong>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehiculos.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Placa</label>
                                <input name="placa" class="form-control my-colorpicker1" value="{{ old('placa') }}"
                                    required>

                                @error('placa')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input class="form-control my-colorpicker1" value="{{ old('placa') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input class="form-control my-colorpicker1" value="{{ old('placa') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="estado">B-SISA</label>
                                    <select name="estado" class="form-control select2" style="width: 100%;">
                                        <option value="1" selected>Hábil</option>
                                        <option value="0">Inhábil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex justify-content-end">
                        <a type="button" class="btn btn-danger mr-2" href="{{ route('premios.index') }}">Cancelar</a>
                        <button type="submit" class="btn btn-info">Guardar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

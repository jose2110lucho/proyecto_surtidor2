@extends('adminlte::page')

@section('title', 'Registrar premio')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR PREMIO</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('premios.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control my-colorpicker1"
                                        value="{{ old('nombre') }}" required>

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="unidades">Unidades</label>
                                    <input name="unidades" class="form-control my-colorpicker1"
                                        value="{{ old('unidades') }}" type="number">

                                    @error('unidades')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="puntos_requeridos">Puntos requeridos</label>
                                    <input name="puntos_requeridos" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('puntos_requeridos') }}" step=".01" min="0">

                                    @error('puntos_requeridos')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-control select2" style="width: 100%;">
                                        <option value="1" selected>Activo
                                        </option>
                                        <option value="0">
                                            Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea name="descripcion" class="form-control my-colorpicker1" style="height: auto">{{ old('descripcion') }}</textarea>

                                    @error('descripcion')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="producto_id">Producto</label>
                                    <select name="producto_id" class="form-control select2" style="width: 100%;">
                                        <option value={{null}}>Sin producto</option>
                                        
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">
                                                {{ $producto->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('premios.index') }}">Cancelar</a>
                                <button type="submit" class="btn btn-info">Guardar</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

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
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings"
                                aria-selected="false">Editar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">

                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p type="text" class="form-control my-colorpicker1">
                                            {{ $cliente->nombre }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <p type="text" class="form-control my-colorpicker1">
                                            {{ $cliente->apellido }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Carnet de identidad</label>
                                        <p type="text" class="form-control my-colorpicker1">{{ $cliente->ci }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <p type="text" class="form-control my-colorpicker1">
                                            {{ $cliente->telefono }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Puntos acumulados</label>
                                        <p type="text" class="form-control my-colorpicker1">
                                            {{ $cliente->puntos }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <p type="text" class="form-control my-colorpicker1">
                                            {{ $cliente->estado ? 'Activo' : 'Inactivo' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                            aria-labelledby="custom-tabs-one-settings-tab">
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
                                            <input name="puntos" type="text" class="form-control my-colorpicker1"
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
                    @if ($cliente->premios->count())

                        <table class="table table-hover table-head-fixed">
                            <thead class="table-light">
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE</th>
                                    <th>PUNTOS</th>
                                    <th>FECHA DE CANJEO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cliente->premios as $premio)
                                    <tr>
                                        <td>{{ $premio->id }}</td>
                                        <td>{{ $premio->nombre }}</td>
                                        <td>{{ $premio->puntos_requeridos }}</td>
                                        <td>{{ \Carbon\Carbon::parse($premio->pivot->created_at)->format('d/m/Y - H:i') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('clientes.destroyPremio',[$cliente, $premio->pivot->id]) }}"
                                                method="post">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex px-3 pt-3 flex-row-reverse">
                            {{-- {{ $clientes->links() }} --}}
                        </div>
                    @else
                        <p class="text-center my-auto py-2">
                            No se encontraron premios
                        </p>
                    @endif
                </div>
            </div>
    </section>
@stop

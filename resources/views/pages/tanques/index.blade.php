@extends('adminlte::page')

@section('title', 'Tanques')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>TANQUES</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE TANQUES REGISTRADOS
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-battery-quarter fa-4x"></span>
                    </div>
                </div>
            </div>
            <!-- SELECT2 EXAMPLE -->
            @foreach ($tanques as $tanque)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Tanque: ' . $tanque->codigo . ' ' . ' ' }}</strong>
                                </h3>
                                <span
                                    class="badge px-1  @if ($tanque->combustible == 'gasolina') bg-orange
                                    @else bg-yellow @endif"
                                    style="width: 60px;">
                                    {{ $tanque->combustible }}
                                </span>
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('tanques.show', $tanque) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('tanques.edit', $tanque) }}">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Capacidad máxima: </label>
                                <p type="text" class="">{{ $tanque->capacidad_max . ' litros' }}</p>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Ultima carga</label>
                                    <p type="text" class="">---</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p type="text" class="">{{ $tanque->estado ? 'Activo' : 'Inactivo' }}</p>
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
                                    <div class="progress-bar text-left p-2 progress-bar-animated 
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
            @endforeach
        </div>
        <!-- /.container-fluid -->
    </section>
@stop

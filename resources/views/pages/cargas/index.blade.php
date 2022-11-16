@extends('adminlte::page')

@section('title', 'Carga')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>CARGA</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE CARGAS REGISTRADAS
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-battery-quarter fa-4x"></span>
                    </div>
                </div>
                </div>
            </div>
            <!-- SELECT2 EXAMPLE -->
            @foreach ($cargas as $carga)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Codigo: ' . $carga->codigo . ' ' . ' ' }}</strong>
                                </h3>
                               
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('cargas.show', $carga) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('cargas.edit', $carga) }}">
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
                            <div class="col-md-3">
                                <label>Fecha</label>
                                <p type="text" class="">{{ $carga->fecha }}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <p type="text" class="">{{ $carga->cantidad}}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio Unitario</label>
                                    <p type="text" class="">{{ $carga->precio_unitario }}</p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio Total</label>
                                    <p type="text" class="">{{ $carga->precio_total }}</p>
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

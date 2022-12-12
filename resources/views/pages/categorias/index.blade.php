@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="bg-dark p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>CATEGORIAS</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE CATEGORIAS REGISTRADAS
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-battery-quarter fa-4x"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div style="text-align: right">
                     <a type="button" class="btn btn-success mr-3"
                          href="{{ route('categorias.export') }}">Excel</a>
                    
                    <a type="button" class="btn btn-warning mr-2"
                          href="{{ route('categorias-html') }}">Html</a>
                     
                     <a type="button" class="btn btn-danger mr-2"
                          href="{{ route('download-pdf') }}">PDF</a>
                </div>
        </div> 
            <!-- SELECT2 EXAMPLE -->
            @foreach ($categorias as $categoria)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Codigo: ' . $categoria->codigo . ' ' . ' ' }}</strong>
                                </h3>
                               
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('categorias.show', $categoria) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('categorias.edit', $categoria) }}">
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
                                <label>Nombre </label>
                                <p type="text" class="">{{ $categoria->nombre}}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Descripcion</label>
                                    <p type="text" class="">{{ $categoria->descripcion}}</p>
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

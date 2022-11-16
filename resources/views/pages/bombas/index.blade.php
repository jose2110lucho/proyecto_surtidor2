@extends('adminlte::page')

@section('title', 'Bombas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
             <div class="bg-black p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>BOMBAS</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE BOMBAS REGISTRADOS
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-battery-quarter fa-4x"></span>
                    </div>
                  
                </div>
            </div>
            <div class="card">
            <!-- SELECT2 EXAMPLE -->
            <div class="form-group">
                <div style="text-align: right">
                     <a type="button" class="btn btn-success mr-3"
                          href="{{ route('bombas.export') }}">Excel</a>
                    
                    <a type="button" class="btn btn-warning mr-2"
                          href="{{ route('bombas-html') }}">Html</a>
                     
                     <a type="button" class="btn btn-danger mr-2"
                          href="{{ route('download-pdf') }}">PDF</a>
                </div>
        </div> 
            @foreach ($bombas as $bomba)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Bomba: ' . $bomba->codigo . ' ' . ' ' }}</strong>
                                </h3>
                                <span
                                    class="badge px-1  @if ($bomba->combustible == 'gasolina') bg-orange
                                    @else bg-yellow @endif"
                                    style="width: 60px;">
                                    {{ $bomba->combustible }}
                                </span>
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('bombas.show', $bomba) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('bombas.edit', $bomba) }}">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p type="text" class="">{{ $bomba->estado ? 'Activo' : 'Inactivo' }}</p>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                </div>

               
            @endforeach
        </div>
        <!-- /.container-fluid -->
    </section>
<!-- /.Paginacion -->
{{ $bombas->links() }} 
@stop

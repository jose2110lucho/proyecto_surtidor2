@extends('adminlte::page')

@section('title', 'cargas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>DATOS DE LA CARGA</strong>
                        </h4>
                        <form action="{{ route('cargas.destroy', $carga) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2" onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('cargas.edit', $carga) }}" class="btn btn-info px-2">
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
                                <label>Codigo</label>
                                <p class="form-control my-colorpicker1">{{ $carga->codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha</label>
                                <p class="form-control my-colorpicker1">{{ $carga->fecha }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <p class="form-control my-colorpicker1">{{ $carga->cantidad }}</p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Unitario</label>
                                <p class="form-control my-colorpicker1">{{ $carga->precio_unitario }}</p>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Total</label>
                                <p class="form-control my-colorpicker1">{{ $carga->precio_total }}</p>
                            </div>
    
                        </div>
                       
                    </div>
                    



                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $carga->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $carga->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
@stop

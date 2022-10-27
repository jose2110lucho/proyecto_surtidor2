@extends('adminlte::page')

@section('title', 'Lista de clientes')

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row g-2">
                        <div class="col-sm-6 p-2">
                            <h3 class="card-title">
                                <strong>LISTA DE CLIENTES</strong>
                            </h3>
                        </div>
                        <div class="col-sm-3 text-right my-auto">
                            <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary"
                                type="button">Nuevo</button>
                        </div>

                        <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo premio</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @include('partials.clientes.form_create')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 my-auto">
                            <form action="{{ route('clientes.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="buscar" id="buscar" type="text" class="form-control"
                                        placeholder="buscar cliente" value="{{ old('buscar') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-default" type="submit">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 450;">
                    @if ($clientes->count())
                        <table class="table table-hover table-head-fixed">
                            <thead class="table-light">
                                <tr>
                                    <th>CI</th>
                                    <th>NOMBRE</th>
                                    <th style="width: 15%">PUNTOS</th>
                                    <th style="width: 15%" class="text-center">ESTADO</th>
                                    {{-- <th style="width: 15%" class="text-center">OPCIONES</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->ci }}</td>
                                        <td><a
                                                href="{{ route('clientes.show', $cliente) }}">{{ $cliente->nombre . ' ' . $cliente->apellido }}</a>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger"
                                                    style="width:{{ $cliente->puntos / 10 }}%"></div>
                                            </div>
                                        </td>


                                        <td class="text-center"><span
                                                class="badge {{ $cliente->estado ? 'bg-success' : 'bg-secondary' }}">{{ $cliente->estado ? 'ACTIVO' : 'INACTIVO' }}</span>
                                        </td>


                                        {{--                                         <td class="text-center">
                                            <a href="{{ route('clientes.show', $cliente) }}" class="mx-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex px-3 pt-3 flex-row-reverse">
                            {{ $clientes->links() }}
                        </div>
                    @else
                        <p class="text-center py-2">
                            No se encontraron clientes
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(window).on('load', function() {
            let a = 'hola'
            if ('{{$errors->any()}}') {
                $('#formCreateModal').modal('show');
            }
        });
    </script>
@stop

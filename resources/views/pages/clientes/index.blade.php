@extends('adminlte::page')

@section('title', 'Clientes')

{{-- @section('content_header')
    <h1>Clientes</h1>
@stop --}}

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
                            <a class="btn btn-primary" href="{{ route('clientes.create') }}">Nuevo</a>
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
                                    <th style="width: 15%" class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->ci }}</td>
                                        <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger"
                                                    style="width:{{ $cliente->puntos / 10 }}%"></div>
                                            </div>
                                        </td>


                                        <td class="text-center"><span class="badge {{$cliente->estado ? 'bg-success' : 'bg-secondary'}}">{{$cliente->estado ? 'ACTIVO' : 'INACTIVO'}}</span></td>


                                        <td class="text-center">
                                            <a href="{{ route('clientes.show', $cliente) }}" class="mx-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
{{--                                             <a href="{{ route('clientes.edit', $cliente) }}" class="mx-2">
                                                <i class="fa fa-pen"></i>
                                            </a> --}}
                                        </td>
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
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->

    </section>
@stop

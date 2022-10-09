@extends('adminlte::page')

@section('title', 'Clientes')

{{-- @section('content_header')
    <h1>Clientes</h1>
@stop --}}

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row g-2">
                        <div class="col-md p-2">
                            <h3 class="card-title">
                                <strong>LISTA DE CLIENTES</strong>
                            </h3>
                        </div>

                        <div class="col-xs">
                            <form action="{{route('clientes.index')}}" method="GET">
                                <div class="input-group">
                                    <input name="buscar" id="buscar" type="text" class="form-control" placeholder="buscar cliente" value="{{ old('buscar') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    @if ($clientes->count())
                        <table class="table table-hover">
                            <thead class="table-light ">
                                <tr>
                                    <th>CI</th>
                                    <th>NOMBRE</th>
                                    <th style="width: 15%">PUNTOS</th>
                                    <th style="width: 40px" class="text-center">ESTADO</th>
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
                                        <td class="text-center"><a href="{{ route('clientes.show', $cliente) }}">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex px-4 py-2 flex-row-reverse">
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

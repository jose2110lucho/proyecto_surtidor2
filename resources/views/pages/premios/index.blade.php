@extends('adminlte::page')

@section('title', 'premios')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row g-2">
                        <div class="col-md p-2">
                            <h3 class="card-title">
                                <strong>LISTA DE PREMIOS</strong>
                            </h3>
                        </div>

                        <div class="col-xs">
                            <button class="btn btn-primary">Nuevo</button>
                        </div>

                    </div>

                </div>

{{--                 <div class="card-body p-0">
                    @if ($premios->count())
                        <table class="table table-hover">
                            <thead class="table-light ">
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>STOCK</th>
                                    <th style="width: 15%">PUNTOS</th>
                                    <th style="width: 15%" class="text-center">ESTADO</th>
                                    <th style="width: 15%" class="text-center">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($premios as $premio)
                                    <tr>
                                        <td>{{ $premio->nombre }}</td>
                                        <td>{{ $premio->unidades }}</td>
                                        <td>{{ $premio->puntos_requeridos }}</td>
                                        <td class="text-center"><span
                                                class="badge {{ $premio->id ? 'bg-success' : 'bg-secondary' }}">{{ $premio->id ? 'ACTIVO' : 'INACTIVO' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('premios.show', $premio) }}" class="mx-2"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="{{ route('premios.edit', $premio) }}" class="mx-2"><i
                                                    class="fa fa-pen"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex px-4 py-2 flex-row-reverse">
                            {{ $premios->links() }}
                        </div>
                    @else
                        <p class="text-center py-2">
                            No se encontraron premios
                        </p>
                    @endif
                </div> --}}

            </div>
        </div>

    </section>
@stop

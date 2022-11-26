@extends('adminlte::page')

@section('content_header')
    <h1>Almacen: Lista de Productos</h1>
@stop

@section('content')

    <div class="d-grid gap-2">
        <a class="btn btn-success" href="{{ route('producto.create') }}"> crear </a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <table class="table caption-top">
                <caption></caption>
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio de compra</th>
                        <th scope="col">Precio de venta</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Accion</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($lista_productos as $producto)
                        <tr>
                            <td>
                                <img src="{{ $producto->imagen? app('firebase.storage')->getBucket()->object($producto->imagen)->signedUrl(Carbon\Carbon::now()->addSeconds(5)): asset('/img/producto-default.jpg') }}"
                                    height="80px">
                            </td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->precio_compra }}</td>
                            <td>{{ $producto->precio_venta }}</td>

                            <td class="text-center" style="display: inline-block"><span
                                    class="badge {{ $producto->estado ? 'bg-success' : 'bg-secondary' }}">{{ $producto->estado ? 'DISPONIBLE' : 'NO DISPONIBLE' }}</span>
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <a style="text-align: right" href="{{ url('/producto/' . $producto->id . '/') }}"
                                        class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a style="text-align: right" href="{{ url('/producto/' . $producto->id . '/edit') }}"
                                        class="btn btn-warning">
                                        <i class="fa fa-pen"></i>
                                    </a>


                                    <form action="{{ url('/producto/' . $producto->id) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
                                            class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>

@stop

@section('js')
    <script>
        function sumar(a, b) {
            return a + b;
        }
    </script>
@endsection

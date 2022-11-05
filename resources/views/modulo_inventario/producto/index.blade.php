@extends('layouts/master')

@section('content_header')
<h1>Lista de Productos</h1>
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
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio de compra</th>
                <th scope="col">Precio de venta</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Imagen</th>
                <th scope="col">Accion</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($lista_productos as $producto)
                  <tr>
                    <th scope="row">{{$producto->id}}</th> 
                    <td >{{$producto->nombre}}</td>
                    <td>{{$producto->precio_compra}}</td>
                    <td>{{$producto->precio_venta}}</td>
                    <td>{{$producto->cantidad}}</td>
                    <td class="text-center" style="display: inline-block" ><span class="badge {{$producto->estado ? 'bg-success' : 'bg-secondary'}}">{{$producto->estado ? 'DISPONIBLE' : 'NO DISPONIBLE'}}</span></td>
                    <td>
                      <img src="{{asset($producto->nombre_imagen)}}" alt="" class="img-fluid img-thumbnail" width="80px">
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

                             <form action="{{ url('/producto/' . $producto->id) }}"
                                     method="post">
                                     @csrf
                                 {{ method_field('DELETE') }}
                                 <button type="submit"
                                 onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
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


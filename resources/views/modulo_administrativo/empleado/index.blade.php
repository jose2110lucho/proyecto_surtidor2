@extends('layouts/master')

@section('content_header')
<h1>Lista de Empleados</h1>
@stop

@section('content')



<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('empleado.create') }}"> crear </a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Estado</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lista_usuarios as $usuario)
                  <tr>
                    <th scope="row">{{$usuario->id}}</th>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->direccion}}</td>
                    <td>{{$usuario->telefono}}</td>
                    <td>{{$usuario->estado}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ url('/empleado/' . $usuario->id . '/edit') }}"
                                 class="btn btn-warning">
                                 Editar
                             </a>
                             <form action="{{ url('/empleado/' . $usuario->id) }}"
                                     method="post">
                                     @csrf
                                 {{ method_field('DELETE') }}
                                 <input type="submit"
                                 onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
                                 value="Borrar" class="btn btn-danger">
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


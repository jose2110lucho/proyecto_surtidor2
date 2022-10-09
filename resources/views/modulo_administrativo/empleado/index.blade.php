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
                <th scope="col">nombre</th>
                <th scope="col">correo</th>
                <th scope="col">direccion</th>
                <th scope="col">estado</th>
                <th scope="col">accion</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lista_usuarios as $usuario)
                  <tr>
                    <th scope="row">{{$usuario->id}}</th>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->direccion}}</td>
                    <td>{{$usuario->estado}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-warning">editar</button>
                            <button type="button" class="btn btn-danger">borrar</button>
                          </div>
                    </td>
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>
  </div>

@stop


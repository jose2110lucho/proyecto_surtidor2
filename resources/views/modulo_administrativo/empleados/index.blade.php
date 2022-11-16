@extends('layouts/master')

@section('content_header')
<h1>Lista de Empleados</h1>
@stop

@section('content')

<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('empleados.create') }}"> crear </a>
</div>

<!-- buscador-->
<div class="card-header">
    <input wire:model="search" class="form-control" placeholder="Buscar">
</div>
<!-- fin buscador-->


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
                @foreach ($user as $usuario)
                  <tr>
                    <th scope="row">{{$usuario->id}}</th>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->direccion}}</td>
                    <td>{{$usuario->telefono}}</td>
                    <td class="text-center" style="display: inline-block"><span class="badge {{$usuario->estado ? 'bg-success' : 'bg-secondary'}}">{{$usuario->estado ? 'ACTIVO' : 'INACTIVO'}}</span></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                          <a href="{{ url('/empleados/' . $usuario->id . '/') }}"
                            class="btn btn-success">
                            <i class="fas fa-eye"></i>
                          </a>

                            <a href="{{ url('/empleados/' . $usuario->id . '/edit') }}"
                                 class="btn btn-warning">
                                 <i class="fas fa-pen"></i>
                            </a>
              
                             <form action="{{ url('/empleados/' . $usuario->id) }}"
                                     method="post">
                                     @csrf
                                 {{ method_field('DELETE') }}
                                 <input type="submit"
                                 onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
                                 value="ELIMINAR" class="btn btn-danger">
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


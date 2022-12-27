@extends('layouts/master')

@section('content_header')
<h1>Notas de Compras de Combustibles</h1>
@stop

@section('content')


<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('cargas.create') }}"> crear </a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                
                <th scope="col">ID</th>
                <th scope="col">Combustible</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Accion</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($lista_nota_carga as $nota_carga)
                  <tr>
                    <th scope="row">{{$nota_carga->id}}</th> 
                    <td >{{$nota_carga->nombre}}</td>
                    <td>{{$nota_carga->fecha}}</td>
                    <td>{{$nota_carga->total}}</td>
              

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            
                          <a style="text-align: right" href="{{ url('cargas/show/'. $nota_carga->id) }}"
                            class="btn btn-success">
                            <i class="fa fa-eye"></i>
                          </a>

                         </div>
                    </td>
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>
  </div>

@stop




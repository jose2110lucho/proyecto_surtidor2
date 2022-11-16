@extends('layouts/master')

@section('content_header')
<h1> Empleado : {{ $usuario->name }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="GET" action = "{{ url('/empleado/' . $usuario->id) }}">
            @csrf
            {{ method_field('POST') }}
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="name" class="form-label">nombre</label>
                <p type="text" class="form-control">{{ $usuario->name }}</p>
            </div>
            <!--fin campo nombre-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="email" class="form-label">correo</label>
                <p type="text" class="form-control">{{ $usuario->email }}</p>
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <p type="text" class="form-control">{{ $usuario->direccion }}</p>
            </div>
            <!--fin campo direccion-->
            <!--inicio campo telefono-->
            <div class="mb-3">
                <label for="telefono" class="form-label">telefono</label>
                <p type="text" class="form-control">{{ $usuario->telefono }}</p>
            </div>
            <!--fin campo telefono-->
            <div class="form-group">
                <label for="estado">Estado</label>
                <p type="text" class="form-control my-colorpicker1">{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</p>
            </div>
            <!--inicio campo cantidad-->
            <div class="row mb-0" style="text-align:right">
                    <div class="col-md-10 offset-md-2">
                        <a href="{{ url('/empleado') }}" class="btn btn-success">
                            Atras
                        </a>
                    </div> 
            </div>          
            <!--fin campo cantidad-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
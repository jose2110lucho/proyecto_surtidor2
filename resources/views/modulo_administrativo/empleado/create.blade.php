@extends('layouts/master')

@section('content_header')
<p>empleado</p>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ route('empleado.store') }}">
            @csrf
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca su nombre">
            </div>
            <!--fin campo nombre-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="correo" class="form-label">correo</label>
                <input name="correo" type="email" class="form-control" id="correo" placeholder="introduzca su correo">
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <input name="direccion" type="text" class="form-control" id="direccion" placeholder="introduzca su direccion">
            </div>
            <!--fin campo direccion-->
            <!--inicio campo contraseña-->
             <div class="mb-3">
                <label for="password" class="form-label">constraseña</label>
                <input name="password" type="password" class="form-control" id="direccion" placeholder="introduzca su constraseña">
            </div>
            <!--fin campo contraseña-->
            <!--inicio campo cantidad-->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">guardar</button>
                <button class="btn btn-secondary">limpiar</button>
            </div>
            <!--fin campo cantidad-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
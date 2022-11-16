@extends('layouts/master')

@section('content_header')
<h1>Empleado</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ route('empleados.store') }}">
            @csrf
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca su nombre" required>
            </div>
            <!--fin campo nombre-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input name="correo" type="email" class="form-control" id="correo" placeholder="introduzca su correo" required>
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input name="direccion" type="text" class="form-control" id="direccion" placeholder="introduzca su direccion" required>
            </div>
            <!--fin campo direccion-->
            <!--inicio campo telefono-->
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input name="telefono" type="number" class="form-control" id="telefono" placeholder="introduzca su telefono" required>
            </div>
            <!--fin campo telefono-->
            <!--inicio campo contraseña-->
             <div class="mb-3">
                <label for="password" class="form-label">Constraseña</label>
                <input name="password" type="password" class="form-control" id="direccion" placeholder="introduzca su constraseña" required>
            </div>
            <!--fin campo contraseña-->
            <!--inicio campo cantidad-->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">guardar</button>
                <a href="{{ url('/empleado') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
            <!--fin campo cantidad-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
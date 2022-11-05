@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar empleado:{{$user->name}}</h1>
@stop

@section('content')
@if(session('info'))
<div class="alert alert-success">
     <strong>{{session('info')}}</strong>
</div>

@endif


<div class="card">
    <div class="card-body">
        {!! Form::model($user, ['route' => ['modulo_administrativo.empleado.update', $user], 'method' => 'put']) !!}
        @csrf
        {{ method_field('PUT') }}
        <!--inicio campo nombre-->
        <div class="mb-3">
            <label for="name" class="form-label">nombre</label>
            <input name="name" type="text" class="form-control" id="name" required value="{{ $usuario->name }}">
        </div>
        <!--fin campo nombre-->
        <!--inicio campo correo-->
        <div class="mb-3">
            <label for="email" class="form-label">correo</label>
            <input name="email" type="email" class="form-control" id="email" required value="{{ $usuario->email }}">
        </div>
        <!--fin campo correo-->
        <!--inicio campo direccion-->
        <div class="mb-3">
            <label for="direccion" class="form-label">direccion</label>
            <input name="direccion" type="text" class="form-control" id="direccion" required value="{{ $usuario->direccion }}">
        </div>
        <!--fin campo direccion-->
        <!--inicio campo telefono-->
        <div class="mb-3">
            <label for="telefono" class="form-label">telefono</label>
            <input name="telefono" type="number" class="form-control" id="telefono" required value="{{ $usuario->telefono }}">
        </div>
        <!--fin campo telefono-->
        <!--inicio campo estado-->
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control select2" style="width: 100%;">
                <option value="1" selected="{{$usuario->estado ? 'selected' : ''}}">Activo</option>
                <option value="0" selected="{{$usuario->estado ? '' : 'selected'}}">Inactivo</option>
            </select>
        </div>
        <!--fin campo estado-->
        <!--inicio campo cantidad-->
        @foreach ($roles as $role)
        <div>
            <label>
                {!! Form::checkbox('roles[]', $role->id, null, ['class' =>'mr-1']) !!}
                {{$role->name}}
            </label>
        </div>
        @endforeach
        <div class="row mb-0">
            <div class="col-md-10 offset-md-2">
                <input type="submit" value="Guardar Datos" class="btn btn-success">
                <a href="{{ url('/empleado') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
        {!! Form::close() !!}
        <!--fin campo cantidad-->
        </form>
        <!--aqui termina el codigo del formulario-->        
    </div>
</div>
@stop
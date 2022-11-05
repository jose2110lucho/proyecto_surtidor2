@extends('layouts/master')

@section('content_header')
<h1>Lista de Asistencias </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('asistencia.index') }}" method="GET">
            <!--aqui empieza el codigo del select-->
            @csrf
            <div class="row mb-3">
                <label for="user_id" class="col-md-2 col-form-label ">Seleccione un turno</label>
                <div class="col-md-10">
                    <select class="form-control" id="turno_id" name="turno_id">
                        @foreach ($turnos_list as $turno)
                        <option value="{{ $turno->id }}">{{ $turno->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select-->
            <!--aqui empieza el codigo del boton guardar-->
            <div class="row mb-0">
                <div class="col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-success">
                        Mostrar
                    </button>
                </div>
            </div>
        </form>
            <!--aqui termina el codigo del boton guardar-->
            <div class="table-responsive">
                <table class="table">
                    <table class="table caption-top">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th scope="col">Empleado</th>
                                <th scope="col">Fecha Entrada</th>
                                <th scope="col">Fecha Salida</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistencias as $asistencia)
                            <tr>
                                <td>{{$asistencia->nombre}}</td>
                                  @if($asistencia->fecha_entrada == '1970-01-01 00:00:00')
                                  <td>----</td>
                                  @else
                                  <td>{{$asistencia->fecha_entrada}}</td>  
                                  @endif
                                  @if($asistencia->fecha_salida == '1970-01-01 00:00:00')
                                  <td>----</td>
                                  @else
                                  <td>{{$asistencia->fecha_salida}}</td> 
                                  @endif
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div> 
    </div>
</div>
@stop
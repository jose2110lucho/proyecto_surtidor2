@extends('adminlte::page')

@section('content_header')
<h1>Lista de bombas de usuario </h1>
@stop

@section('content')

<div class="d-grid gap-2">
    <form method="POST" enctype="multipart/form-data" action="{{ route('empleadobombas.create',$user) }}">
        @csrf
        <select name="bomba_id" id="">
            <option value="">
                elija una opcion
            </option>
            @foreach ($bombas as $bomba)
            <option value="{{$bomba->id}}">
                {{$bomba->nombre}}
            </option>
            @endforeach
        </select>

        @error('bomba_id')
        <small class="text-danger">
            campo requerido
        </small>
        @enderror

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">guardar</button>
        </div>

        </button>

    </form>

</div>
<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">bomba</th>
                    <th scope="col">combustible</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_bombas as $user_bomba)
                <tr>
                    <td>{{ $user_bomba->id }}</td>
                    <td>{{ $user_bomba->Bomba->codigo }}</td>
                    <td>{{ $user_bomba->Bomba->combustible }}</td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <form action="{{ route('empleadobombas.destroy',$user_bomba)}}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="submit" onclick="return confirm('¿Estas Seguro de Eliminarlo?')" value="ELIMINAR" class="btn btn-danger">
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
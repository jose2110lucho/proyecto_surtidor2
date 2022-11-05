<table class="table table-hover table-head-fixed" id="table_vehiculos" width="100%">
    <thead class="table-light">
        <tr>
            <th>PLACA</th>
            <th>TIPO</th>
            <th>MARCA</th>
            <th>B-SISA</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @isset($vehiculos)
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>
                        <a href="{{ route('vehiculos.show', $vehiculo) }}">{{ $vehiculo->placa }}</a>
                    </td>
                    <td>
                        {{ $vehiculo->tipo }}
                    </td>
                    <td>
                        {{ $vehiculo->marca }}
                    </td>
                    <td><span
                            class="badge {{ $vehiculo->b_sisa ? 'bg-success' : 'bg-secondary' }}">{{ $vehiculo->b_sisa ? 'HÁBIL' : 'INHÁBIL' }}</span>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('vehiculos.show', $vehiculo) }}" class="my-auto"><i class="fa fa-eye fa-fw"
                                    aria-hidden="true"></i></a>
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="mx-2"><i
                                    class="fas fa-pen fa-fw"></i></a>

                            <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="my-auto ">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link text-danger my-n2 mx-n2"><i
                                        class="fas fa-trash fa-fw"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endisset
    </tbody>
</table>
<div class="d-flex px-3 pt-3 flex-row-reverse">

</div>

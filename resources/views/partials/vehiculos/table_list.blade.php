@if ($vehiculos->count())
    <table class="table table-hover table-head-fixed">
        <thead class="table-light">
            <tr>
                <th>PLACA</th>
                <th>TIPO</th>
                <th>MARCA</th>
                <th>B-SISA</th>
            </tr>
        </thead>
        <tbody>
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex px-3 pt-3 flex-row-reverse">
        {{ $vehiculos->links() }}
    </div>
@else
    <p class="text-center py-2">
        No se encontraron vehiculos
    </p>
@endif

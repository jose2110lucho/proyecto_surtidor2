@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Usuarios activos</div>
                        </div>
                        <div class="card-body"><canvas id="myChart"></canvas></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Ultimas compras</div>
                        </div>
                        <div class="card-body"><canvas id="myChart"></canvas></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Niveles de combustible</div>
                        </div>
                        <div class="card-body"><canvas id="chart_nivel_combustible"></canvas></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Usuarios activos</div>
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_activos as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role_name() }}</td>
                                            <td>{{ $user->estado }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop

@section('plugins.Chartjs', true);

@section('js')
    <script>
        const ctx = document.getElementById('myChart');

        var combustibles = [];
        var cantidades = [];
        var opacidad = 0.6;

        fetch('{{ route('fetch.combustibles.niveles') }}', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                },
            })
            .then(response => response.json())
            .then((data) => {
                data.forEach(element => {
                    combustibles.push(element.tipo);
                    cantidades.push(parseInt(element.cantidad_disponible));
                });
                generarGrafica();
            });

        const data = {
            labels: combustibles,
            datasets: [{
                label: 'My First dataset',
                fill: false,
                backgroundColor: [
                    `rgb(255, 99, 132, ${opacidad})`,
                    `rgb(75, 192, 192, ${opacidad})`,
                    `rgb(255, 205, 86, ${opacidad})`,
                    `rgb(201, 203, 207, ${opacidad})`,
                    `rgb(54, 162, 235, ${opacidad})`,
                    `rgb(255, 99, 132, ${opacidad})`,
                ],
                data: cantidades,
            }]
        };

        const config = {
            type: 'polarArea',
            data: data,
            options: {
                responsive: true,
            }
        };

        function generarGrafica() {
            new Chart(
                document.getElementById('chart_nivel_combustible'),
                config
            );
        }
    </script>
@stop

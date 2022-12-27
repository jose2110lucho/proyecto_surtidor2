@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Usuarios activos</div>
                        </div>
                        <div class="card-body"><canvas id="combustibles_chart"></canvas></div>
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
                        <div class="card-body"><canvas id="nivel_combustibles_chart"></canvas></div>
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
        <form action="{{ route('fetch.ventas_productos.monto_promedio.mes') }}" method="post">
            @csrf
            <div class="form-group">
                <label for=""></label>
                <select class="form-control form-control-sm" id="rango" name="rango">
                    <option value="3">3 meses</option>
                    <option value="6">6 meses</option>
                    <option value="12">12 meses</option>
                </select>
                <button type="submit">link</button>
            </div>
        </form>
    </section>
@stop

@section('footer')
    <footer>
        <div class="container text-sm">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Acerca de nosotros</h6>
                        <ul class="list-unstyled">
                            <li><a href="#"></a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!--Column2-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Documentcaión</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Website Tutorial</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!--Column3-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Heading 3</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Parks and Recreation</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="text-light font-weight-light">Descarga la app</h6>
                    <a href="#" class="text-sm text-secondary"><i class="fab fa-fw fa-android"></i> Android</a>
                    <br>
                    <a href="#" class="text-sm text-secondary"><i class="fab fa-fw fa-apple"></i> IOS</a>
                </div>
            </div>
            <hr class="bg-gray-dark">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center my-auto">&copy; Copyright 2022 - SOFTIDOR. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
@stop

@section('plugins.Chartjs', true)

@section('css')
    <style>
        .main-footer {
            background-color: rgb(31, 38, 43) !important
        }
    </style>
@stop


@section('js')
    <script>
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
                document.getElementById('nivel_combustibles_chart'),
                config
            );
        }
    </script>

    <script></script>
@stop

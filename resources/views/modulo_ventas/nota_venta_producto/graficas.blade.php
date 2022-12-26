@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-uppercase">
                        <strong> Monto de ventas en los ultimos meses</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="d-flex my-auto" id="flex-loading">
                        </div>
                        <div class="d-flex px-2">
                            <select class="form-control form-control-sm" id="rango_chart_monto_total" name="rango">
                                <option value="3">3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="12">12 meses</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="chart_monto_total_mes"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-uppercase">
                        <strong> Monto promedio por venta</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="d-flex my-auto" id="flex-loading">
                        </div>
                        <div class="d-flex px-2">
                            <select class="form-control form-control-sm" id="rango_chart_monto_promedio" name="rango">
                                <option value="3">3 meses</option>
                                <option value="6">6 meses</option>
                                <option value="12">12 meses</option>
                            </select>
                        </div>
                    </div>
                    <canvas id="chart_monto_promedio_mes"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('plugins.Chartjs', true)

@section('js')
    <script>
        chartMontoTotalMes();

        function chartMontoTotalMes() {
            const ctx = document.getElementById('chart_monto_total_mes');
            var montos = [];
            var meses = [];

            var data = {
                labels: meses,
                datasets: [{
                    label: 'Monto de dinero (bs)',
                    data: montos,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            var config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            chart_monto_total_mes = new Chart(ctx, config);

            function getDatos(request) {
                fetch('{{ route('fetch.ventas_productos.mes') }}', {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        body: JSON.stringify(request),
                    })
                    .then(response => response.json())
                    .then((json) => {
                        json.forEach(element => {
                            meses.push(element.mes);
                            montos.push(parseFloat(element.total));
                        });

                        chart_monto_total_mes.data.labels = meses;
                        chart_monto_total_mes.data.datasets[0].data = montos;
                        chart_monto_total_mes.update();
                        $("#flex-loading").find(".spinner-border").remove();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            let request = {
                'rango': $('#rango_chart_monto_total').val(),
            }
            getDatos(request);


            $('#rango_chart_monto_total').on('change', function() {
                $("#flex-loading").prepend('<div class="spinner-border spinner-border-sm"></div>');
                montos = [];
                meses = [];

                request = {
                    'rango': $('#rango_chart_monto_total').val(),
                }
                getDatos(request);
            })
        }
    </script>

    <script>
        chartMontoPromediolMes();

        function chartMontoPromediolMes() {
            const ctx = document.getElementById('chart_monto_promedio_mes');
            var montos = [];
            var meses = [];

            var data = {
                labels: meses,
                datasets: [{
                    label: 'Monto de dinero (bs)',
                    data: montos,
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    tension: 0.2,
                    borderWidth: 3,
                    pointBorderWidth: 6
                }]
            };

            var config = {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            chart_monto_promedio_mes = new Chart(ctx, config);

            function getDatos(request) {
                fetch('{{ route('fetch.ventas_productos.monto_promedio.mes') }}', {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        body: JSON.stringify(request),
                    })
                    .then(response => response.json())
                    .then((json) => {
                        json.forEach(element => {
                            meses.push(element.mes);
                            montos.push(parseFloat(element.monto_promedio));
                        });
                        console.log(montos)
                        chart_monto_promedio_mes.data.labels = meses;
                        chart_monto_promedio_mes.data.datasets[0].data = montos;
                        chart_monto_promedio_mes.update();
                        $("#flex-loading").find(".spinner-border").remove();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            let request = {
                'rango': $('#rango_chart_monto_promedio').val(),
            }
            getDatos(request);


            $('#rango_chart_monto_promedio').on('change', function() {
                $("#flex-loading").prepend('<div class="spinner-border spinner-border-sm"></div>');
                montos = [];
                meses = [];

                request = {
                    'rango': $('#rango_chart_monto_promedio').val(),
                }
                getDatos(request);
            })
        }
    </script>
@endsection
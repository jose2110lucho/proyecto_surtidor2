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
                },
            }
        };

        chart_monto_promedio_mes = new Chart(ctx, config);
        chart_monto_promedio_mes.height = 200;

        function getDatos(request) {
            fetch('{{ route('fetch.ventas_combustibles.monto_promedio.mes') }}', {
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
                    chart_monto_promedio_mes.data.labels = meses;
                    chart_monto_promedio_mes.data.datasets[0].data = montos;
                    chart_monto_promedio_mes.update();
                    $("#loading_chart_monto_promedio").find(".spinner-border").remove();
                    var image = chart_monto_promedio_mes.toBase64Image();
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
            $("#loading_chart_monto_promedio").prepend('<div class="spinner-border spinner-border-sm"></div>');
            montos = [];
            meses = [];

            request = {
                'rango': $('#rango_chart_monto_promedio').val(),
            }
            getDatos(request);
        })

        $('#export_chart_monto_promedio').on('click', function(a) {
            var a = document.createElement('a');
            a.href = chart_monto_promedio_mes.toBase64Image();
            a.download = 'Gráfico - Monto promedio por venta.png';
            a.click();
        })
    }
</script>

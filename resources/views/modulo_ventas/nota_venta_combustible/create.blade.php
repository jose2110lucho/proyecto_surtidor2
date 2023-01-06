@extends('layouts/master')

@if ($sin_bomba_asignada)
    @section('content')
        <h1>no se le asigno ninguna bomba</h1>
    @endsection
@else
    @section('content')
        <section class="content">
            <div class="container-fluid pt-4">
                @if ($errors->has('errors'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $errors->first('errors') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header my-auto p-0">
                        <div class="col my-auto pt-2 pl-3">
                            <h5 class="card-title"><strong>VENTA DE COMBUSTIBLE</strong></h5><br>
                            <h6 class="text-muted">{{ strtoupper($combustible->nombre) }}</h6>
                        </div>
                    </div>

                    <form action="{{ route('nota_venta_combustible.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-row mb-n2 ">
                                <div class="form-group col-md-1 mr-1 ml-n1">
                                    <img src="https://cdn-icons-png.flaticon.com/512/4371/4371437.png" width="65px">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vendedor" class="font-weight-normal">Vendedor</label>
                                    <input class="form-control form-control-sm bg-white text-muted" name="vendedor"
                                        id="vendedor" value=" {{ Auth::user()->name . ' ' . Auth::user()->apellido }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="turno" class="font-weight-normal">Turno</label>
                                    <p name="turno" class="form-control form-control-sm my-colorpicker1" id="turno">

                                    </p>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bomba" class="font-weight-normal">Bomba</label>
                                    <p name="bomba" class="form-control form-control-sm my-colorpicker1" id="bomba">
                                        {{ $bomba->codigo }}
                                    </p>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="tanque" class="font-weight-normal">Tanque</label>
                                    <p name="tanque" class="form-control form-control-sm my-colorpicker1" id="tanque">
                                        {{ $tanque->codigo }}
                                    </p>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="tanque" class="font-weight-normal">Cant. disp.</label>
                                    <div class="input-group input-group-sm">
                                        <p name="tanque" class="form-control form-control-sm my-colorpicker1"
                                            id="tanque">
                                            {{ $tanque->cantidad_disponible }}
                                        </p>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Litros</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-1 mr-1 ml-n1 my-auto">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2554/2554896.png" width="64px">
                                </div>
                                <div class="form-group col-sm-3" id="input_placa">
                                    <label for="placa">Placa</label>
                                    <input class="form-control" name="placa" id="placa"
                                        style="text-transform:uppercase">
                                    <div class="invalid-feedback" id="placa_error">*Placa no valida</div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="cliente">Cliente (factura)</label>
                                    <input name="cliente" class="form-control my-colorpicker1" id="cliente">
                                    </p>
                                </div>

                                <div class="form-group col-sm-3 ml-2">
                                    <div class="row">
                                        <label>B-SISA</label>
                                    </div>
                                    <div class="row">
                                        <button class="btn btn-outline-primary" id="check_bsisa"type="button"
                                            disabled>Verificar</button>
                                        <p class="text-success my-auto" id="check_bsisa_result" hidden><i
                                                class="fas fa-check fa-fw"></i> Habilitado</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-1 mr-1 ml-n1 my-auto">
                                    <img src="https://cdn-icons-png.flaticon.com/512/747/747781.png" width="65px">
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="precio">Precio de venta</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Bs</span>
                                        </div>
                                        <p name="precio" type="number" class="form-control" id="precio">
                                            {{ $combustible->precio_venta }}</p>
                                    </div>
                                </div>



                                <div class="form-group col-sm-3">
                                    <label for="cantidad_combustible">Cantidad</label>
                                    <div class="input-group">
                                        <input name="cantidad_combustible" type="number" class="form-control"
                                            id="cantidad_combustible" required step="0.01">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Litros</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-sm-3">
                                    <label for="total">Total</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Bs</span>
                                        </div>
                                        <input type="number" name="total" class="form-control my-colorpicker1"
                                            id="total" step="0.1">
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ url('nota_venta_combustible') }}" class="btn btn-secondary  mr-2">Atras</a>
                                <button class="btn btn-success" id="button_confirmar" type="submit"
                                    disabled>Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    @stop
@endif

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $('#placa').on('change', function() {
                if ($(this).val().length == 7) {
                    var numbers = $(this).val().substr(0, 4)
                    var letters = $(this).val().substr(4, 7)

                    if (isStringNumber(numbers) && isStringLetters(letters)) {
                        placaValida();

                        let request = {
                            'placa': $(this).val(),
                        }

                        fetch('{{ route('fetch.clientes.find') }}', {
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
                                if (!jQuery.isEmptyObject(json)) {
                                    $('#cliente').val(json.nombre + ' ' + json.apellido)
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });

                    } else {
                        placaInvalida();
                        bsisaInhabil();
                    }
                } else {
                    placaInvalida();
                    bsisaInhabil();
                }
            })

            $('#check_bsisa').on('click', function() {
                $(this).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verificando...'
                )
                bsisaInhabil();

                setTimeout(function() {
                    $('#check_bsisa').html('Verificar');
                    if (placa) {
                        bsisaHabil();
                    } else {
                        bsisaInhabil();
                    }

                }, 1100);
            })

            function placaValida() {
                $('#check_bsisa').attr("disabled", false)
                $('#placa').removeClass('is-invalid')
                $('#input_placa').removeClass('is-invalid')
            }

            function placaInvalida() {
                $('#check_bsisa').attr("disabled", true)
                $('#placa').addClass('is-invalid')
                $('#input_placa').addClass('is-invalid')
            }

            function bsisaHabil() {
                $('#check_bsisa_result').attr("hidden", false);
                $('#button_confirmar').attr("disabled", false);
            }

            function bsisaInhabil() {
                $('#check_bsisa_result').attr("hidden", true);
                $('#button_confirmar').attr("disabled", true);
            }

            function isStringLetters(string) {
                for (var i = 0; i < string.length; i++) {
                    if (!string.charAt(i).match(/[a-z]/i)) {
                        return false;
                    }
                }
                return true;
            }

            function isStringNumber(string) {
                return string >= 0 && string <= 9999;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var precio = $('#precio').text()
            $('#cantidad_combustible').on('change', function() {
                var total = $(this).val() * precio;
                $('#total').val(Math.round(total * 10) / 10)

            })

            $('#total').on('change', function() {
                var cantidad = $(this).val() / precio;
                $('#cantidad_combustible').val(Math.round(cantidad * 100) / 100)
            })
        })
    </script>
@stop

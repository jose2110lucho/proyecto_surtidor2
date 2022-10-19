@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card card-cyan card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h4 class="my-auto ">
                                <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong>
                            </h4>
                            <p class="my-auto text-muted">
                                Cliente
                            </p>
                        </div>
                        <div class="col-xs-2 text-right">
                            <span class="fa fa-address-card fa-4x"></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted text-sm">
                    <div class="d-flex justify-content-between my-n2">
                        <p class="my-auto"><small>Registrado: {{ $cliente->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>

            </div>

            <div class="card card-purple card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Canjear puntos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings"
                                aria-selected="false">Editar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">
                            <form action="{{ route('clientes.canjear', $cliente) }}" method="post">
                                @csrf
                                <div class="row mb-2 justify-content-center">
                                    <div class="col-sm-4 ">
                                        <div class="form-group @error('premio_id') is-invalid @enderror" id="form_canjeo">
                                            <label for="premio_id">Premio</label>
                                            <select name="premio_id" id="premio_id"
                                                class="form-control select2 @error('premio_id') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value={{ null }}>-- seleccionar premio --</option>

                                                @foreach ($premios as $premio)
                                                    <option value="{{ $premio->id }}">
                                                        {{ $premio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('premio_id')
                                            <div id="validacionPremio" class="invalid-feedback">*{{ $message }}
                                            </div>
                                        @enderror
                                        <div id="validacionPremio" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="unidades">und.</label>
                                            <input type="number" class="form-control my-colorpicker1"
                                                id="unidades" name="unidades" min="1" value="1">
                                            </input>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Puntos requeridos</label>
                                            <p class="form-control my-colorpicker1" id="puntos_requeridos">
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Puntos acumulados</label>
                                            <p class="form-control my-colorpicker1" id="puntos_acumulados">
                                                {{ $cliente->puntos }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-info">Canjear</button>
                                    <a type="button" class="btn btn-danger mx-2"
                                        href="{{ route('clientes.show', $cliente) }}">Cancelar</a>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                            aria-labelledby="custom-tabs-one-settings-tab">

                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
    </section>

    {{--     //var premio = {!! json_encode($premios->find(premioId)->toArray(), JSON_HEX_TAG) !!};
    //console.log(premio.id);
    //$('#puntos_requeridos').val(premioId) --}}
@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#premio_id').on('change', function() {
                var premio_id = this.value;

                if (premio_id) {
                    var premios = {!! json_encode($premios->toArray(), JSON_HEX_TAG) !!};
                    var premio = $.grep(premios, function(e) {
                        return e.id == premio_id;
                    });
                    $('#puntos_requeridos').text(premio[0].puntos_requeridos);

                    var puntos_requeridos_total = premio[0].puntos_requeridos;
                    if (parseInt($('#puntos_requeridos').text()) > parseInt($('#puntos_acumulados')
                            .text())) {
                        $('#validacionPremio').text('Puntos acumulados insuficientes');

                        $("#form_canjeo").addClass("is-invalid");
                        $("#premio_id").addClass("is-invalid");
                    } else {
                        $("#form_canjeo").removeClass("is-invalid");
                        $("#premio_id").removeClass("is-invalid");
                        $("#form_canjeo").addClass("is-valid");
                        $("#premio_id").addClass("is-valid");
                    }

                } else {
                    $('#puntos_requeridos').text('');
                    $('#validacionPremio').text('');
                }

            })
        })
    </script>
@stop

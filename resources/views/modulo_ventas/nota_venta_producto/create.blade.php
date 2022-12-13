@extends('layouts/master')

@section('content_header')
    <h1>Registrar Venta </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!--aqui empieza el codigo del select cliente-->
            <div class="row mb-3">
                <label for="cliente_id" class="col-md-2 col-form-label ">Seleccione un cliente </label>
                <div class="col-md-10">
                    <select class="form-control" id="cliente_id" name="cliente_id">
                        @foreach ($lista_clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select cliente-->
            <!--aqui empieza el codigo del select producto-->
            <div class="row mb-3">
                <label for="producto_id" class="col-md-2 col-form-label ">Seleccione un producto </label>
                <div class="col-md-10">
                    <select class="form-control" id="producto_id" name="producto_id">
                        @foreach ($lista_productos as $producto)
                            <option
                                value="{{ '' . $producto->id . '`' . $producto->nombre . '`' . $producto->precio_venta . '`' . $producto->cantidad  }}">
                                {{ $producto->nombre }}.&nbsp;&nbsp;&nbsp; Bs. {{ $producto->precio_venta }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select producto-->
            <!--inicio campo cantidad-->
            <div class="mb-3">
                <label for="cantidad" class="form-label">cantidad</label>
                <input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="introduzca cantidad"
                    required>
            </div>
            <!--fin campo cantidad-->
            <!------------------inicio tabla dinamica-------------------->
            <button type="button" id="addRow">Agregar producto</button>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>nombre</th>
                        <th>cantidad</th>
                        <th>precio</th>
                        <th>subtotal</th>
                        <th>accion</th>
                    </tr>
                </thead>
            </table>
            <!-------------------fin tabla dinamica----------------------->
            <!--aqui empieza el codigo del boton guardar-->
            <div class="row mb-0">
                <div class="col-md-10 offset-md-2">
                    <button class="btn btn-success" id="guardar">Confirmar</button>
                    <a href="{{ url('nota_venta_producto') }}" class="btn btn-secondary">
                        Atras
                    </a>
                </div>
            </div>
            <!--aqui termina el codigo del boton guardar-->
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //-------------------------------------------------------------------------------------------------------------------------
        $(document).ready(function() {
            var productoList = [];
            var total = 0;
            var t = $('#example').DataTable({
                columnDefs: [{
                    targets: -1,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></button>',
                }, ],
            });

            //----agrega---------------------------------------------------------------------------------------------------------------------

            $('#addRow').on('click', function() {
                let producto_value = document.getElementById("producto_id").value.split('`');
            let cantidad = document.getElementById("cantidad").value;
            let producto_id = producto_value[0];
            let producto = producto_value[1];
            let precio = producto_value[2];
            let producto_cantidad = producto_value[3];
            console.log(cantidad, " " ,producto_cantidad);
            if (parseInt(cantidad) <= parseInt(producto_cantidad)) {
                t.row.add([producto_id, producto, cantidad, precio, cantidad * precio]).draw(false);
                productoList.push({
                    "producto_id": producto_id,
                    "cantidad": cantidad,
                });
                total = total + cantidad * precio;
            }else{
                
                Swal.fire({
                icon: 'warning',
                title: 'Oops...existencias insuficientes',
                text: producto + ' :'  + ' solo disponible ' + producto_cantidad + ' unidades',
                })            
                
            }

        });

        //----elimina---------------------------------------------------------------------------------------------------------------------

        $('#example tbody').on('click', 'button', function() {
            let data_fila = t.row($(this).parents('tr')).data();
            total = total - data_fila[2] * data_fila[3];
            t.row($(this).parents('tr')).remove().draw();
            productoList = productoList.filter(data => data.producto_id != data_fila[0]);
        });

        //-------------------------------------------------------------------------------------------------------------------------

        $("#guardar").click(function(e) {
            var token = '{{ csrf_token() }}';
            let clienteId = document.getElementById("cliente_id").value;
            var data = {
                cliente_id: clienteId,
                _token: token,
                producto_list: productoList,
                total: total
            };
            $.ajax({
                type: "post",
                url: "{{ route('nota_venta_producto.store') }}",
                data: data,
                success: function(nota_venta_producto_id) {
                    window.location.href =
                        `{{ url('/detalle_nota_venta_producto/${nota_venta_producto_id}/') }}`;
                    }
                });
            });
        });

        //-------------------------------------------------------------------------------------------------------------------------        
    </script>
@stop

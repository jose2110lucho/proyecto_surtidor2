@extends('layouts/master')


@section('title', 'Registrar Carga')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-5">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR CARGA</strong>
                        </h4>
                    </div>
                </div>
                <div class="card-body"> 
                    <button type="button" class=" btn btn-primary " data-toggle="modal" 
                        data-target="#exampleModal" >Registrar Nueva Carga
                    </button>
                </div> 

                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="combustible_nombre">Combustible </label>
                    <select class="form-control" id="combustible_nombre" name="combustible_nombre">
                       @foreach ($lista_combustibles as $combustible)
                          <option value="{{ $combustible->id }}">{{ $combustible->nombre }}</option>
                       @endforeach
                    </select>
                    </div>   
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label for="cantidad">Cantidad Total Pedido</label>
                    <input id="cantidad"  name="cantidad" class="form-control my-colorpicker1"
                    value="{{ old('cantidad') }}">
                        @error('cantidad')
                           <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label for="precio_total">Precio Total</label>
                    <input name="precio_total" class="form-control my-colorpicker1" type="number"
                        value="{{ old('precio_total') }}" step=".01" min="0">

                         @error('precio_total')
                            <small class="text-danger">*{{ $message }}</small>
                         @enderror
                    </div>
                </div>
              </div>
            </div>
           <div class="card-body">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                   {{--  {{ csrf_field() }} --}}
                <!--Encapsular el formulario--> 
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Carga</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <div class="mb-3">
                          <label for="recipient-name" class="col-form-label">Tanque:</label>
                          <select name="tanque_codigo" id="tanque_codigo" class="form-control line-s-2" >
                            @foreach ($lista_tanques as $tanque)
                                <option value='{{ $tanque->codigo}}'>{{ $tanque->codigo }}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_tanque">Cantidad Tanque</label>
                            <input id="cantidad_tanque"  name="cantidad_tanque" class="form-control my-colorpicker1" type="number"
                            value="{{ old('cantidad_tanque') }}">
                                @error('cantidad_tanque')
                                   <small class="text-danger">*{{ $message }}</small>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio_unitario">Precio Unitario(Bs)</label>
                            <input id="precio_unitario"name = "precio_unitario" class="form-control my-colorpicker1" type="number"
                                value="{{ old('precio_unitario') }}" step=".01" min="0">
                                    @error('precio_unitario')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                        </div>
                        
                        <!--Termina el formulario??'-->
                      
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addRow">Agregar Tanque </button> 
                    </div>
                  </div>
                
                </div>
              </div>
              {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
             <table id="example" class="display" style="width:100%">
                    <thead>
                         <tr>
                            
                            <th>nombre</th>
                            <th>cantidad</th>
                            <th>Precio</th>
                            <th>subtotal</th>
                            <th>accion</th>
                         </tr>
                     </thead>
                </table>
                <div class="row mb-0">
                    <div class="col-md-10 offset-md-2">
                        <button class="btn btn-success" id="guardar">Guardar</button>
                            <a href="{{ url('nota_cargas') }}" class="btn btn-secondary">
                            Atras
                        </a>
                    </div>
                </div>
            </div>
         </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
   {{--  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>

    <script>
         $(document).ready(function() {
            var tanqueList = [];
            var total = 0;
            var t = $('#example').DataTable({
                columnDefs: [{
                    targets: -1,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>',
                }, ],
            });

            $('#addRow').on('click', function() {
                let tanque_codigo = document.getElementById("tanque_codigo").value;
                let cantidad_tanque = document.getElementById("cantidad_tanque").value;
                let precio = document.getElementById("precio_unitario").value;;
                
                t.row.add([tanque_codigo, cantidad_tanque, precio, cantidad_tanque * precio]).draw(false);
                tanqueList.push({
                    "tanque_codigo": tanque_codigo,
                    "cantidad_tanque": cantidad_tanque,
                    "precio": precio
                });
                total = total + cantidad_tanque * precio;
               
            });


           $('#example').on('click', 'tbody tr', function() {

            let data_fila = t.row(this).data();
            total = total - data_fila[2] * data_fila[3];
            t.row(this).remove().draw();
            tanqueList = tanqueList.filter(data => data.tanque_codigo != data_fila[0]);

             });

             $("#guardar").click(function(e) {
                var token = '{{ csrf_token() }}'; 
                let combustible = document.getElementById("combustible_nombre").value;
                var data = {
                    combustible_nombre: combustible,
                    _token: token, 
                    tanque_list: tanqueList,
                    total: total
                    };
                /* $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    }
                }); */
                $.ajax({
                    type: "post",
                    url: "{{ route('cargas.store') }}",
                    data: data,
                    success: function(cargas_id) {
                         window.location.href=
                        `{{ url('/detalle_carga/${cargas_id}/') }}`;  
                        console.log(cargas_id);
                    }
                });
            });

        });  
       
    </script>
@stop


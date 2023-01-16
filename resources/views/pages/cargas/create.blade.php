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
                  
                    <button type="button" class=" btn btn-warning " data-toggle="modal" 
                        data-target="#exampleModalPrecio" > Editar Precio Combustible
                    </button>
                </div> 


                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="combustible_id">Combustible </label>
                    <select class="form-control" id="combustible_id" name="combustible_id" >
                       @foreach ($lista_combustibles as $combustible)
                          <option value="{{ $combustible->id }}">{{ $combustible->nombre }}</option>
                       @endforeach
                    </select>
                    </div>   
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label for="cantidad">Cantidad del Pedido</label>
                    <input id="cantidad"  name="cantidad" class="form-control my-colorpicker1"
                    value="{{ old('cantidad') }}">
                        @error('cantidad')
                           <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                    <label for="precio_total">Total</label>
                    <input name="precio_total" class="form-control my-colorpicker1" type="number"
                        value="{{ old('precio_total') }}" step=".01" min="0">

                         @error('precio_total')
                            <small class="text-danger">*{{ $message }}</small>
                         @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="precio_unitario">Precio Compra(Bs)</label>
                         <select id="precio_unitario"name = "precio_unitario" class="form-control"> 
                            {{-- <input name="precio_unitario" class="form-control my-colorpicker1" value="{{$combustible->precio_compra}}"> --}}
                            {{--  <input type="number" name="precio_unitario" id="precio_unitario" placeholder="2" value="${{ number_format($combustible->precio_compra, 2) }}" class="form-control total" readonly="">  --}}
                            {{-- value="{{ old('precio_unitario') }}" step=".01" min="0"> --}}
                            {{-- @error('precio_unitario')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror  --}}
                            @foreach ($lista_combustibles as $combustible )
                             <option value="{{ $combustible->id }}"> {{ $combustible->precio_compra }}</option>
                            @endforeach 
                        </select>
                </div>
              </div>
            </div>
           <div class="card-body">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
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
                        
                        
                        <!--Termina el formulario??'-->
                      
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addRow">Agregar Tanque </button> 
                    </div>
                  </div>
                
                </div>
              </div>
              <!--Comienzo del formulario Editar Combustible'-->
              <div class="card-body">
                <div class="modal fade" id="exampleModalPrecio" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel2">Editar Precio de Combustible</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                             <div class="mb-3">
                              <label for="recipient-name" class="col-form-label">Combustible:</label>
                              <select name="combustible" id="combustible" class="form-control line-s-2" >
                                @foreach ($lista_combustibles as $combustible)
                                <option value="{{ $combustible->id }}">{{ $combustible->nombre }}</option>
                             @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="precio_compra">Editar Precio</label>
                                <input id="precio_compra"  name="precio_compra" class="form-control my-colorpicker1" type="number"
                                value="{{ old('precio_compra') }}">
                                    @error('precio_compra')
                                       <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                            </div>
                            
                            
                            <!--Termina el formulario??'-->
                          
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                        <button type="button" class="btn btn-primary" id="editarModal">Guardar </button> 
                        </div>
                      </div>
                    
                    </div>
                  </div>

             <table id="example" class="display" style="width:100%">
                    <thead>
                         <tr>
                            
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Accion</th>
                         </tr>
                     </thead>
                </table>
                <div class="row mb-0">
                    <div class="col-md-10 offset-md-2">
                        <button class="btn btn-success" id="guardar">Guardar</button>
                            <a href="{{ url('cargas/reportes') }}" class="btn btn-secondary">
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
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
                let precio = document.getElementById("precio_unitario").value;//Aqui modifique precio_unitario por precio_compra
                
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
                let combustible = document.getElementById("combustible_id").value;
                var data = {
                    combustible_id: combustible,
                    _token: token,  
                    tanque_list: tanqueList,
                    total: total,
                    };
                
                console.log(data);
                $.ajax({
                    type: "post",
                    url: "{{ route('cargas.store') }}",
                    data: data,
                    success: function(cargas_id) {
                         window.location.href=
                        `{{ url('/cargas/show/${cargas_id}/') }}`;  
                    }
                });
            });

        });  
       
    </script>
@stop


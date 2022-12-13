
@extends('adminlte::page')

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
                
                <form action="{{ route('cargas.store') }}" method="post">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                      
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target="#exampleModal" data-bs-whatever="@mdo">Registrar Nueva Carga
                     </button>
                   
                   
                    
                    
                </form>
                
               
            </div>
            <table id="example" class="display" style="width:100%">       
                <thead>
                    <tr>
                   
                    <th>codigo</th>
                    <th>cantidad</th>
                    <th>precio_unitario</th>
                    <th>subtotal</th>
                    <th>Tanque</th>
                    <th>accion</th>
                    
                    </tr>
                 </thead>

                 <tbody id="tablebody">

                 </tbody>
            </table>

         <!-------------------fin tabla dinamica----------------------->
            <!--aqui empieza el codigo del boton guardar-->
            <div class="row mb-0">
                <div class="col-md-10 offset-md-2">
                    <button class="btn btn-success" id="guardar">Agregar</button>
                    <a href="{{ url('nota_producto') }}" class="btn btn-secondary">
                        Atras
                    </a>
                </div>

            </div>
            <!----->
            <div style="text-align: right">
                <div class="rigth col-md-10 offset-md-2">
                    <button class ="btn btn-danger" id="#">Eliminar</button>
                    <a href="{{ url('#') }}" class="btn btn-warning">
                        Editar
                    </a>
                </div>
            </div>
            
        </div>
            

        

    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
    <!--Encapsular el formulario-->
            <form role="form" method="POST"> 
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Carga</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              
            </div>
            <div class="modal-body">
             

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Combustible:</label>
                    
                    <select name="combustible_id" id="combustible_id" class="form-control line-s-2" >
                        @foreach ($combustibles as $combustible)
                        <option>{{ $combustible }}</option>
                     @endforeach
                      </select>
                  </div>

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Tanque:</label>
                  <select name="tanque_id" id="tanque_id" class="form-control line-s-2" >
                    @foreach ($tanques as $tanque)
                        <option value='{{ $tanque }}'>{{ $tanque }}</option>
                     @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                  <label for="codigo">Codigo</label>
                  <input id="codigo" name="codigo" class="form-control my-colorpicker1" value="{{ old('codigo') }}">
                    @error('codigo')
                        <small class="text-danger">*{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_inicio">Fecha</label>
                    <input name="fecha_inicio" type="datetime-local" class="form-control my-colorpicker1"
                    value="{{ old('fecha', \Carbon\Carbon::today()) }}">
                        @error('fecha')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label for="cantidad">Cantidad Total</label>
                    <input id="cantidad"  name="cantidad" class="form-control my-colorpicker1"
                    value="{{ old('cantidad') }}">
                        @error('cantidad')
                           <small class="text-danger">*{{ $message }}</small>
                        @enderror
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
                <div class="mb-3">
                    <label for="precio_total">Precio Total(Bs)</label>
                    <input name="precio_total" class="form-control my-colorpicker1" type="number"
                        value="{{ old('precio_total') }}" step=".01" min="0">

                    @error('precio_total')
                        <small class="text-danger">*{{ $message }}</small>
                    @enderror
                </div>
                <!--Termina el formulario??'-->
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addRow" onclick="Agregar()"{{--  id="example" --}}> Agregar Tanque</button>
              
            </div>
          </div>
        </form>
        </div>
      </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script type="text/javascript"
        
src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</script>


    <script>
       /*  $(document).ready(function() {
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
                let codigo = document.getElementById("codigo").value;
                let cantidad_tanque = document.getElementById("cantidad_tanque").value;
                let precio_unitario = document.getElementById("precio_unitario").value;
                let tanque_value = document.getElementById("tanque_id").value;
                let tanque_id = codigo[0];
                let tanque= codigo[1];
                
                t.row.add([producto_id, producto, cantidad, precio, cantidad * precio]).draw(false);
                productoList.push({
                    "tanque_id": tanque_id,
                    "cantidad_tanque": cantidad_tanque,
                    "precio_unitario": precio_unitario
                });
                total = total + cantidad_tanque * precio_unitario;
            });



        }); */

        function Agregar(){
        
        let codigo = document.getElementById("codigo").value;
        let cantidad_tanque = document.getElementById("cantidad_tanque").value;
        let precio_unitario = document.getElementById("precio_unitario").value;
        let tanque_id = document.getElementById("tanque_id").value;
        let example = document.getElementById("tablebody");
        let subtotal= precio_unitario*cantidad_tanque;
        let row = `<tr>
        <td >${codigo}</td>
        <td > ${cantidad_tanque}</td>
        <td >${precio_unitario}</td>
        <td >${subtotal} </td>
        <td >${tanque_id}</td>
        </tr>`
        example.innerHTML=example.innerHTML+row;
        console.log(codigo);
           
       } 

      
       
       
         
  

    

//-------------------------------------------------------------------------------------------------------------------------        

    </script>



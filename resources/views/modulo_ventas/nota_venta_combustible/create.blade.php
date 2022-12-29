@extends('layouts/master')

@section('content_header')

@if ($errors->has('errors'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $errors->first('errors') }}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($sin_bomba_asignada)
    <h1>no se le  asigno ninguna bomba</h1>
@else
<div class="card">
    <div class="bg-black p-3">
       <div class="d-flex justify-content-between">
           <div>
               <h3 class="px-3 pt-3">
                   <strong>REGISTRAR VENTA DE COMBUSTIBLE: {{strtoupper($combustible->nombre)}}</strong>
               </h3>
               
           </div>
           <div class="p-3">
               <span class="fas fa-gas-pump fa-5x"></span>
               <p class="px-3 text-sm">
                <h3>nombre: {{$bomba->nombre}}</h3>
                <h3>conectado a: {{$tanque->descripcion}}</h3>
                <h3>cantidad disponible : {{$tanque->cantidad_disponible}} litros</h3>
               </p>
           </div>
         
       </div>
   </div> 
</div>  
@endif

@stop

@section('content')
    @if ($sin_bomba_asignada == false)
    <div class="card">
        
        <form action="{{route('nota_venta_combustible.store')}}" method="POST">
            @csrf
            <div class="card-body">
                <!--aqui empieza el codigo del select vehiculo-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vehiculo_id" >Seleccione una placa(automovil)</label>
                                <select class="js-example-basic-single form-control"  name="vehiculo_id" id="vehiculo_id" onchange="onChangeSelect()">
                                    
                                    <option value="0">seleccionar</option>
                                    
                                    @foreach ($lista_vehiculos as $vehiculo)
                                        
                                            <option value="{{ $vehiculo->id.'`'.$vehiculo->b_sisa }}">{{ $vehiculo->placa}}</option>

                                    @endforeach
                                </select>
                        </div>
                    </div>
                <!--aqui termina el codigo del select vehiculo-->
                <!--inicio campo cantidad de combustible-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cantidad_combustible" id="label_confirmar"  hidden>cantidad de combustible(litros)</label>
                        <input name="cantidad_combustible" type="number" class="form-control" id="cantidad_combustible" placeholder="introduzca cantidad de combustible"  required hidden>
                    </div>
                </div>
                <!--fin campo cantidad de combustible-->      
                </div>
                 <!--inicio campo precio-->
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="precio" id="label_confirmar" >precio(Bs)</label>
                        <input name="precio" type="number" class="form-control" id="precio" value= "{{$combustible->precio_venta}}"  readonly> 
                    </div>
                </div>
                <!--fin campo precio-->
                <!--inicio campo tanque_id-->
                <input type="number" name="tanque_id" value="{{$tanque->id}}" hidden>
                <!--fin campo tanque_id-->
                <!--aqui empieza el codigo del B-SISA-->
                <div class="mb-3"  id="B-SISA" hidden>
                    <label for="B-SISA" class="col-form-label"> 
                       <h2> B-SISA <span class="badge rounded-pill bg-danger" id="B-SisaMsg"></span></h2>
                    </label>     
                </div>
                <!--aqui termina el codigo del B-SISA-->
                <!--aqui empieza el codigo del boton guardar-->
                <div class="d-flex justify-content-end">
                    <a href="{{ url('nota_venta_combustible') }}" class="btn btn-secondary  mr-2">Atras</a>
                    <button class="btn btn-success" id="button_confirmar" type="submit" hidden>Confirmar</button>  
                </div>
                <!--aqui termina el codigo del boton guardar-->
            </div>
        </form>
    </div> 
    @endif

@stop

@section('css')

    <!--select2 css-->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@stop
@section('js')
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!--select2 js-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        //-------------------------------------------------------------------------------------------------------------------------
        function onChangeSelect() {
            
            let vehiculo = document.getElementById("vehiculo_id").value;
            
            vehiculo = vehiculo.split('`')
            
             console.log(vehiculo);

             let button_confirmar = document.getElementById("button_confirmar")
             let label_confirmar = document.getElementById("label_confirmar")
             let imput_confirmar = document.getElementById("cantidad_combustible")

            if (vehiculo[0] == "0") {
                
                document.getElementById("B-SISA").hidden = true;
                button_confirmar.hidden = true;
                label_confirmar.hidden = true;
                imput_confirmar.hidden = true;
                
            } else {


                let elementoB_sisa =  document.getElementById("B-SisaMsg");

                
                if(vehiculo[1]){

                    elementoB_sisa.classList.remove('bg-danger');
                    elementoB_sisa.classList.add('bg-success');
                    elementoB_sisa.innerHTML = "VALIDO"
                    button_confirmar.hidden = false;
                    label_confirmar.hidden = false;
                    imput_confirmar.hidden = false;

                }else{

                    elementoB_sisa.classList.remove('bg-success');
                    elementoB_sisa.classList.add('bg-danger');
                    elementoB_sisa.innerHTML = "NO VALIDO";
                    button_confirmar.hidden = true;
                    label_confirmar.hidden = true;
                    imput_confirmar.hidden = true;
                }

                document.getElementById("B-SISA").hidden = false;
                
            }

        }
        
        $(document).ready(function() {
            $('.js-example-basic-single').select2(); 
            let vehiculo = "{{session('vehiculo_id')}}";
            console.log(vehiculo);

            if(vehiculo != ''){
                $('#vehiculo_id').val(vehiculo).trigger('change');
            }
            
            



        });

        //-------------------------------------------------------------------------------------------------------------------------        
    </script>
@stop

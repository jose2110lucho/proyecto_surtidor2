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
                      
                        <div class="row">
                          <div class="col-md-4">
                                <div class="form-group">
                                      <label for="codigo">Codigo</label>
                                    <input id="codigo" name="codigo" class="form-control my-colorpicker1" value="{{ old('codigo') }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha</label>
                                    <input name="fecha_inicio" type="datetime-local" class="form-control my-colorpicker1"
                                        value="{{ old('fecha', \Carbon\Carbon::today()) }}">
                    
                                    @error('fecha')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input id="cantidad"  name="cantidad" class="form-control my-colorpicker1"
                                        value="{{ old('cantidad') }}">

                                    @error('cantidad')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_unitario">Precio Unitario(Bs)</label>
                                    <input name="precio_unitario" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('precio_unitario') }}" step=".01" min="0">

                                    @error('precio_unitario')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                           

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_total">Precio Total(Bs)</label>
                                    <input name="precio_total" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('precio_total') }}" step=".01" min="0">

                                    @error('precio_total')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanques">Tanques</label>
                                    <select name="tanque_id" id="tanque_id" class="form-control line-s-2" id="tanqueID">
                                    @foreach ($tanques as $tanque)
                                        <option>{{ $tanque }}</option>
                                     @endforeach
                                    </select>
                                 </div>
                                
                            </div>   
                            
                            <div class="col-md-4">
                                <label for="tanques">Combustible</label>
                               <select name="" class="form-control" id="select-combu">
                                    <option value="">Seleccione combustible </option>
                               </select>
                                    @error('cantidad_disponible')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                           
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('cargas.index') }}">Cancelar</a>

                                <button type="submit" class="btn btn-info">Guardar</a>

                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>

        <!-- /.container-fluid -->
    </section>
@stop

@section ('scripts')

<script src="/js/create.js"></script>

@endsection
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
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Tanque') }}
                                    {{ Form::select('tanque_id',$tanques,$cargas->tanque_id,['class'=>'form-control my-colorpicker1',
                                    ($errors->has('tanque_id')? 'is-invalid' : ''), 'placeholder'=>'']) }}
                                     {!! $errors->first('tanque:id','<div class="invalid-feedback">: message</p>') !!}
                                     </div>
                                 </div>
                                
                            </div>                            --}}
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
                                    <label for="fecha">Fecha</label>
                                    <input id="fecha" name="fecha" class="form-control my-colorpicker1"
                                        value="{{ old('fecha') }}">

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
                                    <label for="precio_unitario">Precio Unitario</label>
                                    <input id="precio_unitario" name="precio_unitario" class="form-control my-colorpicker1"
                                        value="{{ old('precio_unitario') }}">

                                    @error('precio_unitario')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_total">Precio Total</label>
                                    <input id="precio_total" name="precio_total" class="form-control my-colorpicker1"
                                        value="{{ old('precio_total') }}" >

                                    @error('precio_total')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanques">Tanques</label>
                                    <select name="cod_tanque" id="cod_tanque" class="form-control line-s-2">
                                    @foreach ($tanques as $tanque)
                                        <option>{{ $tanque }}</option>
                                     @endforeach
                                    </select>
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
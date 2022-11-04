@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!!Form::open(['route'=>'admin.users.create'])!!}
                <div class="form-group">
                <div class="form-group">
                    {!! Form::label('id','ID')!!}
                    {!! Form::text('id',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de la categoría']) !!}

                    @error('id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                    {!! Form::label('nombre','Nombre')!!}
                    {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de la categoría']) !!}

                    @error('nombre')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email','email')!!}
                    {!! Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese el slug de la categoría']) !!}

                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


            {!!Form::close()!!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

    <script>
        $(document).ready( function() {
  $("#name").stringToSlug({
    setEvents: 'keyup keydown blur',
    getPut: '#slug',
    space: '-'
  });
});

    </script>   
@endsection
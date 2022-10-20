<<<<<<< Updated upstream
@extends('layouts/master')

@section('content_header')
    
@stop
=======
@extends('layouts.app')
>>>>>>> Stashed changes

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

<<<<<<< Updated upstream

@stop

@section('css')

@stop

@section('js')
   
@stop

@section('plugins.Sweetalert2', true);
=======
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> Stashed changes

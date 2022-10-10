@extends('layouts/master')

@section('content_header')
    <p>Dashboard_header</p>
@stop

@section('content')

    <p>This is my body content.</p>

    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

@stop
@extends('adminlte::page')

@section('title', 'Proyecto Surtidor')

@section('content_header')
    @yield('content_header')
@stop

@section('content')
    @yield('content')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


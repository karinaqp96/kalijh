@extends('adminlte::page')

@section('title', 'detalleb')

@section('content_header')
    <h1>Detalle de Boleta</h1>
@stop

@section('content')
    @livewire('admin.Detalleb-index')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
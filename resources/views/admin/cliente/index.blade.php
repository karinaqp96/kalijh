@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
    <h1>Cliente</h1>
@stop

@section('content')
    @livewire('admin.Cliente-index')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
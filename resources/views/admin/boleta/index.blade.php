@extends('adminlte::page')

@section('title', 'Boleta')

@section('content_header')
    <h1>Boleta</h1>
@stop

@section('content')
    @livewire('admin.Boleta-index')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
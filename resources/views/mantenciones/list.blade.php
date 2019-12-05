<!-- extiende de intra -->
@extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de mantenciones')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

@section('user')
    {{auth()->user()->name." ".auth()->user()->apellido}}
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de mantenciones')

 <!-- contenido -->
@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Inicio de sesion exitoso!!
    </div>
@endsection

 <!-- scripts -->
@section('js')
    
@endsection
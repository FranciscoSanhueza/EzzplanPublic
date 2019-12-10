 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Prueba calendario')

 <!-- espacio para estilos -->
@section('styles')
    <link href='fullcalendar/core/main.css' rel='stylesheet' />
    <link href='fullcalendar/daygrid/main.css' rel='stylesheet' />


@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Prueba calendario')

 <!-- contenido -->
@section('content')

@endsection

 <!-- scripts -->
@section('js')
    <script src='fullcalendar/core/main.js'></script>
    <script src='fullcalendar/daygrid/main.js'></script>
@endsection
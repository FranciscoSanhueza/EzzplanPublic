<!-- extiende de intra -->
@extends('layouts.intra')

<!-- titulo del navegador -->
@section('title','Prueba calendario')

<!-- espacio para estilos -->
@section('styles')
   <link href= "{{ asset('js/fullcalendar/core/main.css') }} " rel='stylesheet' />
   <link href="{{ asset('js/fullcalendar/daygrid/main.css') }}" rel='stylesheet' />
   <link href="{{ asset('js/fullcalendar/timeGrid/main.css') }}" rel='stylesheet' />
   <link href="{{ asset('js/fullcalendar/bootstrap/main.css') }}" rel='stylesheet' />

@endsection

<!-- titulo de la pagina -->
@section('title_content', 'Prueba calendario')

<!-- contenido -->
@section('content')
<div class="container">
   <div class="row">
       <div id='calendarioWeb'></div>
   </div>
</div>


@component('mantenciones.layouts.insertModal')
   
@endcomponent

@component('mantenciones.layouts.editModal')
   
@endcomponent

@endsection

<!-- scripts -->
@section('js')
   <script src="{{ asset('js\fullcalendar\core\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\daygrid\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\interaction\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\timeGrid\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\bootstrap\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\core\locales\es.js') }}"></script>
   <script src="{{ asset('js\calendar.js') }}"></script>
@endsection
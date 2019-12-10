 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Prueba calendario')

 <!-- espacio para estilos -->
@section('styles')
    <link href= "{{ asset('js/fullcalendar/core/main.css') }} " rel='stylesheet' />
    <link href="{{ asset('js/fullcalendar/daygrid/main.css') }}" rel='stylesheet' />

{{ asset('') }}
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Prueba calendario')

 <!-- contenido -->
@section('content')
<div class="container">
    <div class="row">
        <div id='calendar'></div>
    </div>
</div>

@endsection

 <!-- scripts -->
@section('js')
    <script src="{{ asset('js/fullcalendar/core/main.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/daygrid/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'timeGrid', 'list' ] // an array of strings!
            });

            calendar.render();
      });
    </script>
@endsection
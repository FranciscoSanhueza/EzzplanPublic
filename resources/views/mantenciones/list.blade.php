<!-- extiende de intra -->
@extends('layouts.intra')

<!-- titulo del navegador -->
@section('title','Prueba calendario')

<!-- espacio para estilos -->
@section('styles')
   <link href= "{{ asset('js/fullcalendar/core/main.css') }} " rel='stylesheet' />
   <link href="{{ asset('js/fullcalendar/daygrid/main.css') }}" rel='stylesheet' />
   <link href="{{ asset('js/fullcalendar/timegrid/main.css') }}" rel='stylesheet' />
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
   @slot('fasesOption')
      @foreach ($fases as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
   @endslot

   @slot('equiposOption')
      @foreach ($equipos as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
   @endslot

   @slot('trabajadoresOption')
      @foreach ($trabajadores as $item)
         <option value="{{ $item->id }}">{{$item->nombre." ".$item->apellido}}</option>
      @endforeach
   @endslot

   @slot('insumosOption')
      @foreach ($insumos as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
   @endslot
   @slot('responsableOption')
      @foreach ($responsables as $item)
         <option value="{{ $item->id }}">{{$item->name." ".$item->apellido}}</option>
      @endforeach
   @endslot
@endcomponent

@component('mantenciones.layouts.editModal')
   @slot('fasesOption')
      @foreach ($fases as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
   @endslot

   @slot('equiposOption')
      @foreach ($equipos as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
   @endslot

   @slot('trabajadoresOption')
      @foreach ($trabajadores as $item)
         <option value="{{ $item->id }}">{{$item->nombre." ".$item->apellido}}</option>
      @endforeach
   @endslot

   @slot('insumosOption')
      @foreach ($insumos as $item)
         <option value="{{ $item->id }}">{{$item->nombre}}</option>
      @endforeach
      @endslot
   @slot('responsableOption')
      @foreach ($responsables as $item)
         <option value="{{ $item->id }}">{{$item->name." ".$item->apellido}}</option>
      @endforeach
   @endslot
@endcomponent

@endsection

<!-- scripts -->
@section('js')
   <script src="{{ asset('js\fullcalendar\core\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\daygrid\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\interaction\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\timegrid\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\bootstrap\main.js') }}"></script>
   <script src="{{ asset('js\fullcalendar\core\locales\es.js') }}"></script>
   <script src="{{ asset('js\calendar.js') }}"></script>
@endsection
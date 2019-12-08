 <!-- extiende de intra -->
@extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de Fases')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de Fases')

 <!-- contenido -->
@section('content')
<div class="row">
        <div class="col-8"></div>
        <div class="col-3">
            <a class="btn btn-success" href="fases/create" role="button">+</a>
        </div>
    </div>
    <br/>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($fases as $item)
        <tr>
          <th scope="row">{{ $item->id }}</th>
          <td>{{ $item->nombre }}</td>
          <td>{{ $item->desc }}</td>
          <td>
          <a class="btn btn-info btn-sm" href="{{ route('fases.edit' , $item->id) }}" role="button">Modificar</a>
          <a class="btn btn-danger btn-sm" href="#" onclick="Eliminar({{ $item->id }} , 'la fase')">Eliminar</a> 
          
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <form id="delete-form" action="" class="d-inline" method="POST" style="display: none;">
        @method('DELETE')
        @csrf
    </form> 
@endsection

 <!-- scripts -->
@section('js')
  @if (session('msj'))
    @component('layouts.toast')
      @slot('tipo', 'success')
      @slot('title', 'Eliminado')
      @slot('body' , session('msj'))
    @endcomponent
  @endif
@endsection
<!-- extiende de intra -->
@extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de Insumos')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de Insumos')

 <!-- contenido -->
@section('content')
<div class="row">
    <div class="col-8"></div>
    <div class="col-3">
        <a class="btn btn-success" href="Insumos/create" role="button">+</a>
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
    @if(session('msj'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{session('msj')}}
      </div>
    @endif


    @foreach ($insumos as $item)
    <tr>
      <th scope="row">{{ $item->id }}</th>
      <td>{{ $item->nombre }}</td>
      <td>{{ $item->desc }}</td>
      <td>
      <a class="btn btn-info btn-sm" href="{{ route('Insumos.edit' , $item->id) }}" role="button">Modificar</a>
      <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal">Eliminar</a>
          <form id="delete-form" action="{{ route('Insumos.destroy', $item->id) }}" class="d-inline" method="POST" style="display: none;">
              @method('DELETE')
              @csrf
          </form> 
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@component('layouts.modalConfirm')
@slot('id' , 'deleteModal')
@slot('title' , '¿Estas seguro que deseas eliminar?')
@slot('body')
    <p>Si Eliminas el insumo no podra ser recuperado</p>
@endslot
@slot('actionbtn')
<a 
class="btn btn-danger" 
href="#"
onclick="event.preventDefault(); document.getElementById('delete-form').submit();" >
Eliminar
</a>  
@endslot
@endcomponent

@endsection

 <!-- scripts -->
@section('js')
    
@endsection
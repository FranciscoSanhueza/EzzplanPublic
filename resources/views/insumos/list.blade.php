@extends('layouts.app')
@section('title', 'Control Insumos')
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
          <a class="btn btn-info btn-sm" href="Insumos/{{$item->id}}/edit" role="button">Modificar</a>

          <form action="{{ route('Insumos.destroy', $item->id) }}" class="d-inline" method="POST">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
          </form> 
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
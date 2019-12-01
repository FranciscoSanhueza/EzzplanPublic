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
    @foreach ($insumos as $item)
    <tr>
      <th scope="row">{{ $item->id }}</th>
      <td>{{ $item->nombre }}</td>
      <td>{{ $item->desc }}</td>
      <a class="btn btn-success" href="Insumos/{{$item->id}}" role="button">+</a>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
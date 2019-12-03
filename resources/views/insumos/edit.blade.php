@extends('layouts.app')
@section('title', 'Control Insumos')
@section('content')
<form class="form-group" method="POST" action="/Insumos">
    @csrf
    <div class="form-group">
        <label for="txt_nombre">Nombre</label>
        <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" value="{{ $insumoed->nombre }}">
    </div>

    @error('txt_nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-group">
        <label for="txt_descripcion">Descripcion</label>
    <textarea class="form-control" id="txt_descripcion" name="txt_descripcion" rows="3">{{$insumoed->desc}}</textarea>
    </div>

    @error('txt_descripcion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary">Registrar</button>
</form>

@isset($msgInsert)
    <div class="alert alert-success">{{ $msgInsert }}</div>
@endisset
@endsection
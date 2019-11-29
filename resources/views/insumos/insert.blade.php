@extends('layouts.app')
@section('title', 'Control Insumos')
@section('content')
<form class="form-group" method="POST" action="/Insumos">
    @csrf
    <div class="form-group">
        <label for="txt_nombre">Nombre</label>
        <input type="text" class="form-control" id="txt_nombre" name="txt_nombre">
    </div>
    <div class="form-group">
        <label for="txt_descripcion">Descripcion</label>
        <textarea class="form-control" id="txt_descripcion" name="txt_descripcion" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>
@isset($msgInsert)
    {{$msgInsert}}
@endisset
@endsection
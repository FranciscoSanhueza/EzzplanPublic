@extends('layouts.app')
@section('title', 'Control Insumos')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Modificacion de Insumo '.$insumoed->nombre) }}</div>
                <div class="card-body">
                <form class="form-group" method="POST" action="{{ route('Insumos.update', $insumoed->id ) }}">
                    @method('PUT')    
                    @csrf       
                                                  
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $insumoed->nombre }}">
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{$insumoed->desc}}</textarea>
                            
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>    
                        </div>
                    
                    
                        <div class="form-group row">
                            <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Empresa') }}</label>
                    
                            <div class="col-md-7">
                                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado">
                                        <option value="1" selected>Activo</option>
                                        <option value="2" >Inactivo</option>
                                </select>
                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                             <div class="col-md-6 offset-md-8">
                                <button type="submit" class="btn btn-primary rigth">Actualizar</button>
                            </div>       
                        </div>
                        
                    </form>
                    <br/>
                    @isset($msgInsert)
                        <div class="alert alert-success">{{ $msgInsert }}</div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
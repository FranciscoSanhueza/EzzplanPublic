 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de Equipos')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de Equipos')

 <!-- contenido -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Modificacion de Equipo '.$equipoed->nombre) }}</div>
                <div class="card-body">
                    <form class="form-group" method="POST"
                        action="{{ route('equipos.update', $equipoed->id ) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{$equipoed->nombre}}" required >
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-7">
                                <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required > {{ $equipoed->desc }} </textarea>
                            
                            @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>    
                        </div>


                        <div class="form-group row">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    @foreach ($tipos as $item)
                                        @if ($item->id != $equipoed->tipo->id)
                                            <option value="{{ $item->id }}">{{$item->nombre}}</option>
                                        @else
                                            <option value="{{ $item->id }}" selected>{{$item->nombre}}</option> 
                                        @endif
                                    @endforeach
                                </select>
                                @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="departamento" class="col-md-4 col-form-label text-md-right">{{ __('Departamento') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('departamento') is-invalid @enderror" id="departamento" name="departamento" required>
                                    @foreach ($departamentos as $item)
                                        @if ($item->id != $equipoed->departamento->id)
                                            <option value="{{ $item->id }}">{{$item->nombre}}</option>
                                        @else
                                            <option value="{{ $item->id }}" selected>{{$item->nombre}}</option> 
                                        @endif
                                    @endforeach
                                </select>
                                @error('departamento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fabricante" class="col-md-4 col-form-label text-md-right">{{ __('Fabricante') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('fabricante') is-invalid @enderror" id="fabricante" name="fabricante" required>
                                    @foreach ($fabricantes as $item)
                                        @if ($item->id != $equipoed->fabricante->id)
                                            <option value="{{ $item->id }}">{{$item->nombre}}</option>
                                        @else
                                            <option value="{{ $item->id }}" selected>{{$item->nombre}}</option> 
                                        @endif
                                    @endforeach
                                </select>
                                @error('fabricante')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha Ingreso</label>
                            <div class="col-md-7">
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ $equipoed->fechaIngreso }}" required >
                                @error('fecha')
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
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- scripts -->
@section('js')
@isset($msgInsert)
       @component('layouts.toast')
           @slot('tipo', 'success')
           @slot('title', 'Modificado')
           @slot('body' , 'Equipo Modificado correctamente' ) 
       @endcomponent
   @endisset
@endsection

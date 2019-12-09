 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de Fabricantes')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de Fabricantes')

 <!-- contenido -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Ingreso de Fabricantes') }}</div>
                <div class="card-body">
                <form class="form-group" method="POST" action="{{ route('fabricantes.store') }}">
                        @csrf
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required >
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
                                        <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required > {{ old('desc') }} </textarea>
                                    
                                    @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>    
                            </div>

                            <div class="form-group row">
                                <label for="origen" class="col-md-4 col-form-label text-md-right">Origen</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control @error('origen') is-invalid @enderror" id="origen" name="origen" value="{{ old('origen') }}"  >
                                    @error('origen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}"  >
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="correo" class="col-md-4 col-form-label text-md-right">Mail</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}"  >
                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="web" class="col-md-4 col-form-label text-md-right">Web</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control @error('web') is-invalid @enderror" id="web" name="web" value="{{ old('web') }}"  >
                                    @error('web')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-8">
                                    <button type="submit" class="btn btn-primary rigth">Registrar</button>
                                </div>       
                            </div>
                        </form>
                        <br/>
      
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
    @slot('title', 'Ingresado')
    @slot('body' , 'Fabricante Ingresado correctamente' ) 
@endcomponent
@endisset
@endsection
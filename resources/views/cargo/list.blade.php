 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
@section('title','Control de Cargos')

 <!-- espacio para estilos -->
@section('styles')
    
@endsection

 <!-- titulo de la pagina -->
@section('title_content', 'Control de Cargos')

 <!-- contenido -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Ingreso de Insumos') }}</div>
                <div class="card-body">
                <form class="form-group" method="POST" action="{{ route('Insumos.store') }}">
                        @csrf
                            <div class="form-group row">
                                <label for="txt_nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control @error('txt_nombre') is-invalid @enderror" id="txt_nombre" name="txt_nombre" value="{{ old('txt_nombre') }}" required >
                                    @error('txt_nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label for="txt_descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                                    <div class="col-md-7">
                                        <textarea class="form-control @error('txt_descripcion') is-invalid @enderror" id="txt_descripcion" name="txt_descripcion" rows="3" required > {{ old('txt_descripcion') }} </textarea>
                                    
                                    @error('txt_descripcion')
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
    
@endsection
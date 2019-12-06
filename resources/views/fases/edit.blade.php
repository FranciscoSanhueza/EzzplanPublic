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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Modificacion de Fase: '.' '. $faseed->nombre ) }}</div>
                <div class="card-body">
                <form class="form-group" method="POST" action="{{ route('fases.update', $faseed->id )}}">
                        @csrf
                        @method('PUT')    
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ $faseed->nombre }}" required >
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
                                        <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" rows="3" required > {{ $faseed->desc }} </textarea>
                                    
                                    @error('desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>    
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-8">
                                    <button type="submit" class="btn btn-primary rigth">Modificar</button>
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
        @slot('title', 'Modificado')
        @slot('body' , 'Fase Modificada correctamente' ) 
    @endcomponent
    @endisset
@endsection
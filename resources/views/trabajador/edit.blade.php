 <!-- extiende de intra -->
 @extends('layouts.intra')

 <!-- titulo del navegador -->
 @section('title','Control de Trabajadores')

 <!-- espacio para estilos -->
 @section('styles')

 @endsection

 <!-- titulo de la pagina -->
 @section('title_content', 'Control de Trabajadores')

 <!-- contenido -->
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-10">
             <div class="card">
                 <div class="card-header">{{ __('Modificacion de Trabajador '.$trabajadored->nombre." ".$trabajadored->apellido) }}</div>
                 <div class="card-body">
                     <form class="form-group" method="POST"
                         action="{{ route('trabajadores.update', $trabajadored->id ) }}">
                         @method('PUT')
                         @csrf

                         <div class="form-group row">
                             <label for="run" class="col-md-4 col-form-label text-md-right">Run</label>
                             <div class="col-md-7">
                                 <input type="text" class="form-control @error('run') is-invalid @enderror" id="run"
                                     name="run" value="{{ $trabajadored->run  }}" required>
                                 @error('run')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
                             <div class="col-md-7">
                                 <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                     id="nombre" name="nombre" value="{{ $trabajadored->nombre  }}" required>
                                 @error('nombre')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>
                             <div class="col-md-7">
                                 <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                     id="apellido" name="apellido" value="{{ $trabajadored->apellido  }}" required>
                                 @error('apellido')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>
                             <div class="col-md-7">
                                 <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                     id="telefono" name="telefono" value="{{ $trabajadored->telefono }}" required>
                                 @error('telefono')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Cargo') }}</label>

                             <div class="col-md-6">
                                 <select class="form-control @error('cargo') is-invalid @enderror" id="cargo"
                                     name="cargo" required>
                                     @foreach ($cargos as $item)
                                        @if ($item->id != $trabajadored->cargo->id)
                                            <option value="{{ $item->id }}">{{$item->nombre}}</option>
                                        @else
                                            <option value="{{ $item->id }}" selected>{{$item->nombre}}</option> 
                                        @endif
                                     @endforeach
                                 </select>
                                 @error('cargo')
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
            @slot('body' , 'Trabajador Modificado correctamente' ) 
        @endcomponent
    @endisset
 @endsection

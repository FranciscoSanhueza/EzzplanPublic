<!-- extiende de intra -->
@extends('layouts.intra')

<!-- titulo del navegador -->
@section('title','Editar Informacion')

<!-- espacio para estilos -->
@section('styles')
   
@endsection

<!-- titulo de la pagina -->
@section('title_content', 'Editar Informacion')

<!-- contenido -->
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-10">
           <div class="card">
               <div class="card-header">{{ __('Modificacion del Usuario '.$user->nombre." ".$user->apellido ) }}</div>
               <div class="card-body">
                   <form class="form-group" method="POST"
                       action="{{ route('users.update', $user->id ) }}">
                       @method('PUT')
                       @csrf
                       <div class="form-group row">
                        <label for="run" class="col-md-4 col-form-label text-md-right">{{ __('Run') }}</label>

                        <div class="col-md-6">
                            <input id="run" type="text" class="form-control @error('run') is-invalid @enderror" name="run" value="{{ $user->run }}" autocomplete="run" autofocus readonly>
                            @error('run')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                        <div class="col-md-6">
                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $user->apellido }}" required autocomplete="apellido">

                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="empresa" class="col-md-4 col-form-label text-md-right">{{ __('Empresa') }}</label>

                        <div class="col-md-6">
                            <select class="form-control @error('empresa') is-invalid @enderror" id="empresa" name="empresa" readonly >
                                <option value="{{ $user->empresa->id }}" selected>{{$user->empresa->Nombre}}</option> 
                            </select>
                            @error('empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
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
          @slot('body' , 'Informacion Modificada Correctamente' ) 
      @endcomponent
  @endisset
@endsection

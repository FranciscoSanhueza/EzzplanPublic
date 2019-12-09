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
 <div class="row">
     <div class="col-8"></div>
     <div class="col-3">
         <a class="btn btn-success" href="cargos/create" role="button"><i class="fas fa-plus"></i></a>
     </div>
 </div>
 <br />
 <table class="table" id="dtb">
     <thead>
         <tr>
             <th scope="col">id</th>
             <th scope="col">Nombre</th>
             <th scope="col">Funcion</th>
             <th scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>

         @foreach ($cargo as $item)
         <tr>
             <th scope="row">{{ $item->id }}</th>
             <td>{{ $item->nombre }}</td>
             <td>{{ $item->funcion }}</td>
             <td>
                 <a class="btn btn-info btn-sm" href="{{ route('cargos.edit' , $item->id) }}"
                     role="button"><i class="fas fa-edit"></i></a>
                 <a class="btn btn-danger btn-sm" href="#"
                     onclick="Eliminar('{{ route('cargos.destroy', $item->id) }}', 'el Cargo');"><i class="fas fa-trash-alt"></i></a>
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>


 <form id="delete-form" action="" class="d-inline" method="POST" style="display: none;">
     @method('DELETE')
     @csrf
 </form>
 @endsection

 <!-- scripts -->
 @section('js')
 @if (session('msj'))
    @component('layouts.toast')
      @slot('tipo', 'success')
      @slot('title', 'Eliminado')
      @slot('body' , session('msj'))
    @endcomponent
  @endif

  <script>
    $(document).ready( function () {
    $('#dtb').DataTable();
    } );
  </script>
 @endsection

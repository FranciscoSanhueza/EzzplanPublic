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
 <div class="row">
     <div class="col-8"></div>
     <div class="col-3">
         <a class="btn btn-success" href="{{ route('fabricantes.create') }}" role="button"><i class="fas fa-plus"></i></a>
     </div>
 </div>
 <br />
 <table class="table" id="dtb">
     <thead>
         <tr>
             <th scope="col">id</th>
             <th scope="col">Nombre</th>
             <th scope="col">Descripción</th>
             <th scope="col">Origen</th>
             <th scope="col">Telefono</th>
             <th scope="col">Correo</th>
             <th scope="col">Web</th>
             <th scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>

         @foreach ($fabricante as $item)
         <tr>
             <th scope="row">{{ $item->id }}</th>
             <td>{{ $item->nombre }}</td>
             <td>{{ $item->desc }}</td>
             <td>{{ $item->Origen }}</td>
             <td>{{ $item->telefono }}</td>
             <td>{{ $item->Correo }}</td>
             <td>{{ $item->Web }}</td>
             <td>
                 <a class="btn btn-info btn-sm" href="{{ route('fabricantes.edit' , $item->id) }}" role="button"><i
                         class="fas fa-edit"></i></a>
                 <a class="btn btn-danger btn-sm" href="#"
                     onclick="Eliminar('{{ route('fabricantes.destroy', $item->id) }}' , 'el Fabricante')"><i
                         class="fas fa-trash-alt"></i></a>
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

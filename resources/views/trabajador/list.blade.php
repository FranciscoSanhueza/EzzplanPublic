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
 <div class="row">
     <div class="col-8"></div>
     <div class="col-3">
         <a class="btn btn-success" href="{{ route('trabajadores.create') }}" role="button"><i class="fas fa-plus"></i></a>
     </div>
 </div>
 <br />
 <table class="table" id="dtb">
     <thead>
         <tr>
             <th scope="col">id</th>
             <th scope="col">Run</th>
             <th scope="col">Nombre</th>
             <th scope="col">Apellido</th>
             <th scope="col">Cargo</th>
             <th scope="col">Telefono</th>
             <th scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>

         @foreach ($trabajador as $item)
         <tr>
             <th scope="row">{{ $item->id }}</th>
             <td>{{ $item->run }}</td>
             <td>{{ $item->nombre }}</td>
             <td>{{ $item->apellido }}</td>
             <td>{{ $item->cargo->nombre }}</td>
             <td>{{ $item->telefono }}</td>
             <td>
                 <a class="btn btn-info btn-sm" href="{{ route('trabajadores.edit' , $item->id) }}" role="button"><i
                         class="fas fa-edit"></i></a>
                 <a class="btn btn-danger btn-sm" href="#"
                     onclick="Eliminar('{{ route('trabajadores.destroy', $item->id) }}' , 'el Trabajador')"><i
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

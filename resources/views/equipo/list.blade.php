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
 <div class="row">
     <div class="col-8"></div>
     <div class="col-3">
         <a class="btn btn-success" href="{{ route('equipos.create') }}" role="button"><i class="fas fa-plus"></i></a>
     </div>
 </div>
 <br />
 <table class="table" id="dtb">
     <thead>
         <tr>
             <th scope="col">id</th>
             <th scope="col">Nombre</th>
             <th scope="col">Descripcion</th>
             <th scope="col">Tipo</th>
             <th scope="col">Departamento</th>
             <th scope="col">Fabricante</th>
             <th scope="col">Fecha LLegada</th>
             <th scope="col">Acciones</th>
         </tr>
     </thead>
     <tbody>

         @foreach ($equipo as $item)
         <tr>
             <th scope="row">{{ $item->id }}</th>
             <td>{{ $item->nombre }}</td>
             <td>{{ $item->desc }}</td>
             <td>{{ $item->tipo->nombre }}</td>
             <td>{{ $item->Departamento->nombre }}</td>
             <td>{{ $item->fabricante->nombre }}</td>
             <td>{{ $item->fechaIngreso }}</td>
             <td>
                 <a class="btn btn-info btn-sm" href="{{ route('equipos.edit' , $item->id) }}" role="button"><i
                         class="fas fa-edit"></i></a>
                 <a class="btn btn-danger btn-sm" href="#"
                     onclick="Eliminar('{{ route('equipos.destroy', $item->id) }}' , 'el Equipo')"><i
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

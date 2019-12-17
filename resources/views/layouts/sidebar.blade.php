<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mantenciones.index') }}">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Ezzplan</div>
        </a>
  
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
  
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
        <a class="nav-link" href="{{ route('mantenciones.index') }}">
            <i class="fas fa-fw fa-calendar-day"></i>
            <span>Mantenciones</span></a>
        </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Control
        </div>
        

               <!-- Nav Item - Fases -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('fases.index') }}">
                <i class="fas fa-fw fa-toolbox"></i>
                <span>Fases</span></a>
            </li>



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Equipos</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Control de Equipos</h6>
              <a class="collapse-item" href="{{ route('equipos.index') }}">Equipos</a>
              <a class="collapse-item" href="{{ route('fabricantes.index') }}">Fabricantes</a>
            </div>
          </div>
        </li>
  
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Recursos</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manejo de recursos:</h6>
              <a class="collapse-item" href="{{ route('Insumos.index') }}">Insumos</a>
              <a class="collapse-item" href="{{ route('trabajadores.index') }}">Trabajadores</a>
              <a class="collapse-item" href="{{ route('cargos.index') }}">Cargos</a>
            </div>
          </div>
        </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Informacion
        </div>

           <!-- Nav Item - usuarios -->
           <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">
            <i class="fas fa-fw fa-toolbox"></i>
            <span>Usuarios</span></a>
        </li>
  
  
  
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
  
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
  
      </ul>
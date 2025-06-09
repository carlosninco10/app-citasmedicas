<!-- sidebar -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a href="{{ route('panel') }}" class="nav-link active">
                <i class="fa-solid fa-house fa-lg me-2"></i>
                <span class="text-center mt-1">Inicio</span>
            </a>
        </li>

        <!--  <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="bi bi-amd"></i>
          <span>AMD</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="bi bi-alexa"></i>
          <span>Alexa</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="bi bi-amazon"></i>
          <span>Amazon</span>
        </a>
      </li> -->

        <li class="nav-heading">Modulos</li>

        <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="nav-link">
                <i class="fa-solid fa-users fa-lg me-2"></i>
                <span class="text-center mt-1">Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('especialistas.index') }}" class="nav-link">
                <i class="fa-solid fa-book fa-lg me-2"></i>
                <span class="text-center mt-1">Especialistas</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('medicos.index') }}" class="nav-link">
                <i class="fa-solid fa-stethoscope me-2"></i>
                <span class="text-center mt-1">Médicos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('disponibilidades.index') }}" class="nav-link">
                <i class="fa-solid fa-check me-2"></i>
                <span class="text-center mt-1">Administración disponibilidad</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('citas.index') }}" class="nav-link">
                <i class="fa-solid fa-calendar-check fa-lg me-2"></i>
                <span class="text-center mt-1">Programación de citas</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="fa-solid fa-person-circle-plus fa-lg me-2"></i>
                <span class="text-center mt-1">Roles</span>
            </a>
        </li>
    </ul>
</aside> <!-- sidebar ends -->

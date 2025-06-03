  <!-- header -->
  <header id="header" class="header fixed-top d-flex align-items-center">

      <div class="d-flex align-items-center justify-content-between">
          <a href="{{ route('panel') }}" class="logo d-flex align-items-center">
              Sistema Citas Medicas
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>

      <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
              <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <img src="https://dummyimage.com/400x400/444444/d3d3d3.png" alt="avatar" class="rounded-circle">
                      <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          <h6>{{ auth()->user()->name }}</h6>
                          @switch(auth()->user()->rol)
                              @case('paciente')
                                  <span class="text-secondary">Paciente</span>
                              @break

                              @case('medico')
                                  <span class="text-secondary">Médico</span>
                              @break

                              @case('admin')
                                  <span class="text-secondary">Administrador</span>
                              @break
                          @endswitch
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="bi bi-person"></i>
                              <span>Mi perfil</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="#">
                              <i class="bi bi-gear"></i>
                              <span>Configuración de la cuenta</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>
                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Cerrar sesión</span>
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>
      </nav>
  </header>
  <!-- header ends -->

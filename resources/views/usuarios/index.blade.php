    @extends('template')

    @section('title','Usuarios')

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.all.min.js"></script>
        @endpush

    @section('content')

    @if (session('success'))
           <script type="text/javascript" >
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Operación exitosa"
});
    </script>
    @endif

    <div class="container-fluid px-4">
      <div class="row g-3 justify-content-between mb-3">
        <div class="mt-4 text-center">
          <h5>Usuarios</h5>
        </div>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
        </ol>
      </div>
    <div class="mb-4">
    <a class="btn btn-primary" href="{{ route('usuarios.create') }}" role="button">Añadir nuevo registro</a>
    </div>
     <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tablas Pacientes
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario )
                                           <tr>
                                        <th>{{ $usuario->nombre }}</th>
                                        <th>{{ $usuario->correo }}</th>
                                        <th>
                                        @switch($usuario->rol)
                                        @case('paciente')
                                           <span class="text-black">Paciente</span>
                                        @break
                                        @case('medico')
                                               <span class="text-black">Médico</span>
                                        @break
                                        @case('admin')
                                               <span class="text-black">Administrador</span>
                                        @break
                                    @endswitch

                                        </th>
                                        <th>
                                            <div class="container-fluid" >
                                            <div class="row">
                                                <div class="col-md-3">
                                                <form action="{{ route('usuarios.edit', [$usuario]) }}" method="GET">
     <button type="submit" class="btn btn-warning" ><i class="bi bi-pencil"></i></button>
                                                </form>
                                                </div>
                                                <div class="col-md-3">
     <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $usuario->id }}"><i class="bi bi-trash"></i></button>
</div>
                                            </div>
                                            </div>
                                        </th>
                                        </tr>
                                        <!-- Modal -->
<div class="modal fade" id="confirmModal-{{ $usuario->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Mensaje de confirmación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres eliminar el usuario? {{ $usuario->id }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <form action="{{ route('usuarios.destroy', [$usuario]) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Confirmar</button>
        </form>
      </div>
    </div>
  </div>
</div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
    </div>
</div>
    </div>
    @endsection

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}" ></script>
    @endpush

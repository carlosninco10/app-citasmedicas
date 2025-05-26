    @extends('template')

    @section('title','Crear Usuario')

    @push('css')

    @endpush

    @section('content')
    <div class="container-fluid px-4">
      <div class="row g-3 justify-content-between mb-3">
        <div class="mt-4 text-center">
          <h5>Crear Usuario</h5>
        </div>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Crear Usuario</li>
        </ol>
      </div>
    <div class="container w-100">
        <div class="row justify-content-center">
              <div class="col-lg-6 col-md-8 col-sm-6">
        <div class="card shadow">
          <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="post">
                @csrf
                    <div class="mb-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
                        @error('correo')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" id="contrasena" class="form-control">
                        @error('contrasena')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" id="rol" class="form-select" aria-label="form-select rol">
                            <option selected disabled>Elige una opción</option>
                            <option value="paciente">Paciente</option>
                            <option value="medico">Médico</option>
                            <option value="admin">Administrador</option>
                        </select>
                         @error('rol')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-primary" role="button">Crear</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    @endsection

    @push('js')

    @endpush

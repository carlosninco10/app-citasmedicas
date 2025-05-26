    @extends('template')

    @section('title','Crear Usuario')

    @push('css')

    @endpush

    @section('content')
    <div class="container-fluid px-4">
      <div class="row g-3 justify-content-between mb-3">
        <div class="mt-4 text-center">
          <h5>Editar Usuario</h5>
        </div>
        <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar Usuario</li>
        </ol>
      </div>
        <div class="container w-100">
        <div class="row justify-content-center">
              <div class="col-lg-6 col-md-8 col-sm-6">
        <div class="card shadow">
          <div class="card-body">
            <form action="{{ route('usuarios.update', ['usuario'=> $usuario]) }}" method="post">
                @method('PATCH')
                @csrf
                    <div class="mb-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}">
                        @error('nombre')
                            <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}">
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
                            <option disabled>Elige una opción</option>
                            <option value="paciente" {{ $usuario->rol == 'paciente' ? 'selected' : '' }}>Paciente</option>
                            <option value="medico" {{ $usuario->rol == 'medico' ? 'selected' : ''}}>Médico</option>
                            <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : ''}}>Administrador</option>
                        </select>
                         @error('rol')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-primary" role="button">Crear</button>
                        <button type="reset" class="btn btn-secondary" role="button">Reiniciar</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    @endsection

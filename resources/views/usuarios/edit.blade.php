    @extends('template')

    @section('title', 'Editar Usuario')

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
                                <form action="{{ route('usuarios.update', ['usuario' => $usuario]) }}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $usuario->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Correo</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email', $usuario->email) }}">
                                        @error('email')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                        @error('password')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="rol" class="form-label">Seleccione rol:</label>
                                        <select name="rol" id="rol" class="form-select" aria-label="form-select rol">
                                            @foreach ($roles as $item)
                                            @if(in_array($item->name,$usuario->roles->pluck('name')->toArray()))
                                            <option selected value="{{$item->name}}" @selected(old('rol') == $item->name)>{{$item->name}}</option>
                                            @else
                                            <option value="{{$item->name}}" @selected(old('rol') == $item->name)>{{$item->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('rol')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4 text-center">
                                        <button type="submit" class="btn btn-primary" role="button">Actualizar</button>
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

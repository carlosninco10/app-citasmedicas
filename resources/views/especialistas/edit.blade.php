    @extends('template')

    @section('title', 'Editar Especialista')

    @push('css')
    @endpush

    @section('content')
        <div class="container-fluid px-4">
            <div class="row g-3 justify-content-between mb-3">
                <div class="mt-4 text-center">
                    <h5>Editar Especialista</h5>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('especialistas.index') }}">Especialistas</a></li>
                    <li class="breadcrumb-item active">Editar Especialista</li>
                </ol>
            </div>
            <div class="container w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('especialistas.update', ['especialista' => $especialista]) }}"
                                    method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                            value="{{ old('nombre', $especialista->nombre) }}">
                                        @error('nombre')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $especialista->descripcion) }}</textarea>
                                        @error('descripcion')
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

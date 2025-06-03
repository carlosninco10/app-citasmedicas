    @extends('template')

    @section('title', 'Crear Especialista')

    @push('css')
    @endpush

    @section('content')
        <div class="container-fluid px-4">
            <div class="row g-3 justify-content-between mb-3">
                <div class="mt-4 text-center">
                    <h5>Crear Especialista</h5>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('especialistas.index') }}">Especialistas</a></li>
                    <li class="breadcrumb-item active">Crear Especialista</li>
                </ol>
            </div>
            <div class="container w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('especialistas.store') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                            value="{{ old('nombre') }}">
                                        @error('nombre')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                                        @error('descripcion')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
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

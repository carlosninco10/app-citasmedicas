    @extends('template')

    @section('title', 'Crear disponibilidad médica')

    @push('css')
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    @endpush

    @section('content')
        <div class="container-fluid px-4">
            <div class="row g-3 justify-content-between mb-3">
                <div class="mt-4 text-center">
                    <h5>Crear disponibilidad médica</h5>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('disponibilidades.index') }}">Disponibilidad</a></li>
                    <li class="breadcrumb-item active">Crear disponibilidad médica</li>
                </ol>
            </div>
            <div class="container w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('disponibilidades.store') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="medico_especialidad_id" class="form-label">Nombre médico</label>
                                        <select name="medico_especialidad_id" id="medico_especialidad_id"
                                            class="form-control selectpicker show-tick border" title="Elige una opción"
                                            data-live-search="true" data-size="3" aria-label="form-control medico_especialidad_id">
                                            @foreach ($medicos as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('medico_especialidad_id' == $item->id ? 'selected' : '') }}>
                                                    {{ $item->usuario->name.' - '.$item->especialista->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('medico_especialidad_id')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="fecha" class="form-label">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control"
                                            value="{{ old('fecha') }}">
                                        @error('fecha')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="hora_inicio" class="form-label">Hora Inicio</label>
                                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control"
                                            value="{{ old('hora_inicio') }}">
                                        @error('hora_inicio')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="hora_fin" class="form-label">Hora Fin</label>
                                        <input type="time" name="hora_fin" id="hora_fin" class="form-control"
                                            value="{{ old('hora_fin') }}">
                                        @error('hora_fin')
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    @endpush

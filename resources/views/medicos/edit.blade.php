    @extends('template')

    @section('title', 'Editar médicos especialistas')

    @push('css')
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    @endpush

    @section('content')
        <div class="container-fluid px-4">
            <div class="row g-3 justify-content-between mb-3">
                <div class="mt-4 text-center">
                    <h5>Editar médicos especialista</h5>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medicos.index') }}">Médicos especialistas</a></li>
                    <li class="breadcrumb-item active">Editar médicos especialista</li>
                </ol>
            </div>
            <div class="container w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <form action="{{ route('medicos.update', [$medico]) }}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-4">
                                        <label for="medico_id" class="form-label">Nombre médico</label>
                                        <select name="medico_id" id="medico_id"
                                            class="form-control selectpicker show-tick border" title="Elige una opción"
                                            data-live-search="true" data-size="3" aria-label="form-control medico_id">
                                            @foreach ($medicosUsuarios as $item)
                                                @if ($medico->medico_id == $item->id)
                                                    <option selected value="{{ $item->id }}"
                                                        {{ old('medico_id' == $item->id ? 'selected' : '') }}>
                                                        {{ $item->name }}</option>
                                                @else
                                                    <option value="{{ $item->id }}"
                                                        {{ old('medico_id' == $item->id ? 'selected' : '') }}>
                                                        {{ $item->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('medico_id')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="especialidad_id" class="form-label">Especialista</label>
                                        <select name="especialidad_id[]" id="especialidad_id[]"
                                            class="form-control selectpicker show-tick border" title="Elige una opción"
                                            data-live-search="true" data-size="3" multiple
                                            aria-label="form-control especialidad_id">
                                            @foreach ($especialistas as $item)
                                                @if (in_array($item->id, $medico->usuario->medicoEspecialista->pluck('id')->toArray()))
                                                    <option selected value="{{ $item->id }}"
                                                        {{ in_array($item->id, old('especialidad_id', [])) ? 'selected' : '' }}>
                                                        {{ $item->nombre }}</option>
                                                @else
                                                    <option value="{{ $item->id }}"
                                                        {{ in_array($item->id, old('especialidad_id', [])) ? 'selected' : '' }}>
                                                        {{ $item->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('especialidad_id')
                                            <small class="text-danger">{{ '*' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4 text-center">
                                        <button type="submit" class="btn btn-primary" role="button">Editar</button>
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

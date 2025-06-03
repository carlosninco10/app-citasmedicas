@extends('template')

@section('title', 'Editar cita médica')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endpush

@section('content')
    <div class="container-fluid px-4">
        <div class="row g-3 justify-content-between mb-3">
            <div class="mt-4 text-center">
                <h5>Crear cita médica</h5>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('citas.index') }}">Citas médicas</a></li>
                <li class="breadcrumb-item active">Editar cita médica</li>
            </ol>
        </div>
        <div class="container w-100">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ @route('citas.update', $cita->id) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="mb-4">
                                    <label for="paciente_id" class="form-label">Nombre paciente</label>
                                    <select name="paciente_id" id="paciente_id"
                                        class="form-control selectpicker show-tick border" title="Elige un paciente"
                                        data-live-search="true" data-size="3" aria-label="form-control paciente_id">
                                        @foreach ($pacientes as $paciente)
                                            <option value="{{ $paciente->id }}"
                                                {{ old('paciente_id', $cita->paciente_id) == $paciente->id ? 'selected' : '' }}>
                                                {{ $paciente->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('paciente_id')
                                        <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="disponibilidad_id" class="form-label">Médico especialista</label>
                                    <select name="disponibilidad_id" id="disponibilidad_id"
                                        class="form-control selectpicker show-tick border" title="Elige una disponibilidad"
                                        data-live-search="true" data-size="3" aria-label="form-control disponibilidad_id">
                                        @foreach ($disponibilidades as $disp)
                                            <option value="{{ $disp->id }}"
                                                {{ old('disponibilidad_id', $cita->disponibilidad_id) == $disp->id ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::parse($disp->fecha)->format('d-m-Y') . ' | ' . \Carbon\Carbon::parse($disp->hora_inicio)->format('h:i A') . ' - ' . \Carbon\Carbon::parse($disp->hora_fin)->format('h:i A') . ' | ' . $disp->medicoEspecialista->usuario->nombre . ' (' . $disp->medicoEspecialista->especialista->nombre . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('disponibilidad_id')
                                        <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ old('observaciones', $cita->observaciones) }}</textarea>
                                    @error('observaciones')
                                        <small class="text-danger">{{ '* ' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-select" aria-label="form-select estado">
                                        <option selected disabled>Elige una opción</option>
                                        @php
                                            $estadoActual = old('estado', $cita->estado);
                                        @endphp
                                        <option value="pendiente" {{ $estadoActual == 'pendiente' ? 'selected' : '' }}>
                                            Pendiente</option>
                                        <option value="confirmada" {{ $estadoActual == 'confirmada' ? 'selected' : '' }}>
                                            Confirmada</option>
                                        <option value="cancelada" {{ $estadoActual == 'cancelada' ? 'selected' : '' }}>
                                            Cancelada</option>
                                        <option value="realizada" {{ $estadoActual == 'realizada' ? 'selected' : '' }}>
                                            Realizada</option>
                                    </select>
                                    @error('estado')
                                        <small class="text-danger">{{ '* ' . $message }}</small>
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

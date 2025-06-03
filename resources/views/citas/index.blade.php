    @extends('template')

    @section('title', 'Citas médicas')

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.all.min.js"></script>
    @endpush

    @section('content')

        @if (session('success'))
            <script type="text/javascript">
                let message = "{{ session('success') }}";
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1800,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            </script>
        @endif

        <div class="container-fluid px-4">
            <div class="row g-3 justify-content-between mb-3">
                <div class="mt-4 text-center">
                    <h5>Citas médicas</h5>
                </div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Citas médicas</li>
                </ol>
            </div>
            <div class="mb-4">
                <a class="btn btn-primary" href="{{ route('citas.create') }}" role="button">Añadir nuevo registro</a>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabla usuarios
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Médico</th>
                                    <th>Especialidad</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->paciente->name ?? 'N/A' }}</td>
                                        <td>{{ $cita->disponibilidad->fecha ?? 'N/A' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($cita->disponibilidad->hora_inicio)->format('h:i A') ?? '' }}
                                            -
                                            {{ \Carbon\Carbon::parse($cita->disponibilidad->hora_fin)->format('h:i A') ?? '' }}
                                        </td>
                                        <td>{{ $cita->disponibilidad->medicoEspecialista->usuario->name ?? 'N/A' }}</td>
                                        <td>{{ $cita->disponibilidad->medicoEspecialista->especialista->nombre ?? 'N/A' }}
                                        </td>
                                        <td>{{ $cita->observaciones ?? '-' }}</td>
                                        <td>
                                            @switch($cita->estado)
                                                @case('pendiente')
                                                    <span class="badge bg-warning text-white">Pendiente</span>
                                                @break

                                                @case('confirmada')
                                                    <span class="badge bg-primary text-white">Confirmada</span>
                                                @break

                                                @case('cancelada')
                                                    <span class="badge bg-danger text-white">Cancelada</span>
                                                @break

                                                @case('realizada')
                                                    <span class="badge bg-success text-white">Realizada</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary text-white">Desconocido</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-4 me-1">
                                                        <form action="{{ route('citas.edit', $cita->id) }}" method="GET">
                                                            <button type="submit" class="btn btn-warning"><i
                                                                    class="fas fa-pen text-white" title="Editar"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-4 ml-1">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmModal-{{ $cita->id }}"><i
                                                                class="fa-regular fa-eye" title="Ver"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal-{{ $cita->id }}" tabindex="-1"
                                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmModalLabel">Ver información cita
                                                        médica
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="estado" class="form-label">Estado</label>
                                                        <select name="estado" class="form-control">
                                                            <option value="pendiente"
                                                                {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>
                                                                Pendiente</option>
                                                            <option value="confirmada"
                                                                {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>
                                                                Confirmada</option>
                                                            <option value="cancelada"
                                                                {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>
                                                                Cancelada</option>
                                                            <option value="realizada"
                                                                {{ $cita->estado == 'realizada' ? 'selected' : '' }}>
                                                                Realizada</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="observaciones" class="form-label">Observaciones</label>
                                                        <textarea name="observaciones" class="form-control" rows="3">{{ $cita->observaciones }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
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
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    @endpush

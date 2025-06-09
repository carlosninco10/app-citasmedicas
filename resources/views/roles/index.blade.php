@extends('template')

@section('title', 'Roles')

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
                <h5>Roles</h5>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('roles.create') }}" role="button">Añadir nuevo
                rol</a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Roles
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $item)
                                </tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 me-1">
                                                <form action="{{ route('roles.edit', ['role' => $item]) }}"
                                                    method="GET">
                                                    <button type="submit" class="btn btn-warning"><i
                                                            class="fas fa-pen text-white" title="Editar"></i></button>
                                                </form>
                                            </div>
                                            <div class="col-md-4 ml-1">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal-{{ $item->id }}"><i
                                                    class="bi bi-trash" title="Eliminar"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Mensaje de
                                                    confirmación
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Seguro que quieres eliminar este rol ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <form action="{{ route('roles.destroy', ['role' => $item]) }}"
                                                    method="post">
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
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush

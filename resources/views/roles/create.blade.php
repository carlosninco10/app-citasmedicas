@extends('template')

@section('title', 'Crear Roles')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <div class="row g-3 justify-content-between mb-3">
            <div class="mt-4 text-center">
                <h5>Crear Rol</h5>
            </div>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Crear Rol</li>
            </ol>
        </div>
        <div class="container w-100">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label for="nombre" class="form-label">Nombre Rol</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ '*' . $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                        <label for="descripcion" class="form-label">Permisos para el rol:</label>
                                        
                                        @foreach ($permisos as $item)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" name="permission[]" id="{{$item->id}}" class="form-check-input" value="{{$item->id}}">
                                                <label for="{{$item->id}}" class="form-check-label">{{$item->name}}</label>  
                                            </div>
                                        @endforeach

                                        @error('permission')
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

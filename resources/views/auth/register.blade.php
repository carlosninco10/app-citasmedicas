<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="main-bg">
    <!-- Login Form -->
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6 col-md-8 col-sm-8">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">Registro</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <small class="text-danger">{{ '* ' . $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" />
                                @error('password')
                                    <small class="text-danger">{{ '* ' . $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" />
                                @error('password')
                                    <small class="text-danger">{{ '* ' . $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="checkbox" class="form-check-input" id="aceptarterms" name="aceptarterms" />
                                <label for="aceptarterms" class="form-label">Acepto todos los términos y
                                    condiciones.</label>
                                @error('aceptarterms')
                                    <small class="text-danger">{{ '* ' . $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-bg-primary">Crear cuenta</button>
                            </div>
                        </form>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">¿Ya tienes cuenta?
                            <a href="{{ route('login') }}" class="text-dark fw-bold">Inicia Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
</body>

</html>

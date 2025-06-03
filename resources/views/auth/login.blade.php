<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.21.2/dist/sweetalert2.all.min.js"></script>
</head>

<body class="main-bg">
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
    <!-- Login Form -->
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card shadow">
                    <div class="card-title text-center border-bottom">
                        <h2 class="p-3">Acceso al sistema</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $item)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $item }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email') }}" />
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control" id="password" />
                            </div>
                            <div class="mb-4">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }} />
                                <label for="remember" class="form-label">Recuérdame</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-bg-primary">Iniciar sesión</button>
                            </div>
                            <div id="emailHelp" class="form-text text-center mb-5 text-dark">¿No tienes cuenta?
                                <a href="{{ route('register') }}" class="text-dark fw-bold">Regístrate</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
</body>

</html>

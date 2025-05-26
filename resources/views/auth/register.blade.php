<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
            <form>
              <div class="mb-4">
                <label for="username" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="username" />
              </div>
              <div class="mb-4">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" required />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" required />
              </div>
              <div class="mb-4">
                <label for="passwordverify" class="form-label">Confirmar contraseña</label>
                <input type="passwordverify" class="form-control" id="passwordverify" required />
              </div>
              <div class="mb-4">
                <input type="checkbox" class="form-check-input" id="acceptterms" required />
                <label for="acceptterms" class="form-label">Acepto todos los términos y condiciones.</label>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn text-bg-primary">Iniciar sesión</button>
              </div>
              <div id="emailHelp" class="form-text text-center mb-5 text-dark">¿No tienes cuenta?
                <a href="" class="text-dark fw-bold">Regístrate</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
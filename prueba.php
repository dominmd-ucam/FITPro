<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Test Menú Hamburguesa</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

  <!-- HEADER CON MENÚ HAMBURGUESA -->
  <header class="main-page-header bg-dark text-white">
    <div class="container-fluid px-4 py-2 d-flex justify-content-between align-items-center navbar navbar-dark">
      <!-- Logo -->
      <a href="#" class="navbar-brand">
        <img src="https://via.placeholder.com/120x40?text=FitPro" alt="FitPro" style="height: 40px;">
      </a>

      <!-- Botón hamburguesa -->
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#hamburgerMenu" aria-controls="hamburgerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Menú colapsable -->
    <div class="collapse navbar-collapse bg-dark px-4 py-3" id="hamburgerMenu">
      <!-- Ventajas -->
      <div class="d-flex flex-column flex-lg-row gap-3 text-warning mb-3">
        <div><i class="bi bi-geo-alt-fill"></i> 1500+ Clubs</div>
        <div><i class="bi bi-hammer"></i> Mejor Equipamiento</div>
        <div><i class="bi bi-door-open-fill"></i> Acceso a todos los Gimnasios</div>
      </div>

      <!-- Menú -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="menu1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Entrenamientos y consejos
          </a>
          <ul class="dropdown-menu" aria-labelledby="menu1">
            <li><a class="dropdown-item" href="#">Todo sobre entrenamientos</a></li>
            <li><a class="dropdown-item" href="#">Todo sobre nutrición</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link text-white" href="#">Entrenadores</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">Comunidad</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#">Quiénes somos</a></li>
      </ul>

      <!-- Botones -->
      <a class="btn btn-warning my-2 me-3" href="#">APÚNTATE</a>
      <div class="d-flex flex-column flex-lg-row gap-3 mt-3">
        <a href="#" class="btn btn-outline-light">
          <i class="bi bi-person-circle"></i> Mi cuenta FitPro
        </a>
        <a href="#" class="btn btn-outline-light">
          <i class="bi bi-question-circle"></i> Atención al cliente
        </a>
      </div>
    </div>
  </header>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

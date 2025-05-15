<!-- Header con logo y título -->
<header class="header-fitpro w-100 bg-gradient-orange position-relative" style="height: 420px;">
  <div class="container d-flex justify-content-start pt-4">
    <a href="index.php">
      <img src="assets/imagenes/logofitpro.png" alt="Logo FitPro" class="img-fluid" style="height: 180px;">
    </a>
  </div>

  <!-- Título centrado -->
  <div class="position-absolute top-50 start-50 translate-middle text-center px-3 px-sm-0">
    <h1 class="text-white text-uppercase fw-bold display-5 display-md-4 m-0" style="font-family: 'Sora', sans-serif;">
      Registro
    </h1>
  </div>

  <!-- Líneas decorativas SOLO para pantallas grandes -->
  <div class="d-none d-lg-block">
    <!-- SVG superior derecha -->
    <div class="header-decoration position-absolute top-0 end-0">
      <svg width="236" height="216" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M223.03 8 72.39 158.64" stroke="#1e2c3b" stroke-width="20" stroke-miterlimit="10" />
        <path d="m228.681 71.99-70.64 70.64M78.64 79.74 8 150.381" stroke="#ffffff" stroke-width="20" stroke-miterlimit="10" />
        <path d="m54.96 176.08-32.07 32.06" stroke="#3b4d61" stroke-width="20" stroke-miterlimit="10" />
      </svg>
    </div>

    <!-- SVG reflejo inferior -->
    <div class="header-decoration position-absolute" style="top: 216px; right: 0; transform: scaleY(-1);">
      <svg width="236" height="216" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M223.03 8 72.39 158.64" stroke="#1e2c3b" stroke-width="20" stroke-miterlimit="10" />
        <path d="m228.681 71.99-70.64 70.64M78.64 79.74 8 150.381" stroke="#ffffff" stroke-width="20" stroke-miterlimit="10" />
        <path d="m54.96 176.08-32.07 32.06" stroke="#3b4d61" stroke-width="20" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
</header>

<!-- Formulario centrado debajo del header -->
<div class="login-wrapper d-flex justify-content-center align-items-start px-3 px-sm-4" style="background-color: #f8f9fa; min-height: calc(100vh - 320px);">
  <div class="login-card card border-0 w-100 shadow"
       style="max-width: 420px; margin-top: -120px; z-index: 10; border-radius: 1rem;">
    <div class="card-body p-4">
      <!-- Mensaje de error -->
      <?php if (!empty($message)) : ?>
        <div class="alert alert-danger fw-bold text-center" role="alert">
          <?= htmlspecialchars($message) ?>
        </div>
      <?php endif; ?>

      <!-- Formulario -->
      <form action="" method="post">
        <div class="mb-4">
          <label for="uname" class="form-label fw-bold fs-5">Usuario</label>
          <input type="text" class="form-control fs-5"
                 style="background-color: #2D425A; color: white; font-weight: bold;"
                 id="uname" name="nombre" placeholder="Introduce tu usuario" required>
        </div>

        <div class="mb-4">
          <label for="email" class="form-label fw-bold fs-5">Email</label>
          <input type="email" class="form-control fs-5"
                 style="background-color: #2D425A; color: white; font-weight: bold;"
                 id="email" name="email" placeholder="Introduce tu email" required>
        </div>

        <div class="mb-4">
          <label for="pswd" class="form-label fw-bold fs-5">Contraseña</label>
          <input type="password" class="form-control fs-5"
                 style="background-color: #2D425A; color: white; font-weight: bold;"
                 id="pswd" name="pswd" placeholder="Introduce tu contraseña" required>
        </div>

        <button type="submit" name="registro_submit" class="btn btn-primary w-100 fw-bold fs-5">
          Registrarse
        </button>

        <div class="text-center mt-3">
          <span class="text-dark fw-bold">¿Ya tienes cuenta?</span>
          <a href="index.php?controlador=miembros&action=login" class="fw-bold text-primary text-decoration-none">
            Inicia sesión aquí
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

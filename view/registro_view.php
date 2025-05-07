<!-- Header con logo a la izquierda y título centrado -->
<header class="header-fitpro w-100 bg-gradient-orange position-relative" style="height: 420px;">
    <!-- Contenedor superior con logo -->
    <div class="container d-flex justify-content-start pt-4">
    <a href="index.php">
        <img src="assets/imagenes/logofitpro.png" alt="Logo FitPro" style="height: 240px;" class="img-fluid">
    </a>
</div>


    <!-- Título centrado sobre el header -->
    <div class="position-absolute top-50 start-50 translate-middle text-center">
        <h1 class="text-white text-uppercase fw-bold display-4 text-center m-0">
            Registro
        </h1>
    </div>

    <!-- Líneas decorativas arriba a la derecha -->
    <div class="header-decoration position-absolute top-0 end-0">
        <svg width="236" height="216" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M223.03 8 72.39 158.64" stroke="#1e2c3b" stroke-width="20" stroke-miterlimit="10"/>
            <path d="m228.681 71.99-70.64 70.64M78.64 79.74 8 150.381" stroke="#ffffff" stroke-width="20" stroke-miterlimit="10"/>
            <path d="m54.96 176.08-32.07 32.06" stroke="#3b4d61" stroke-width="20" stroke-miterlimit="10"/>
        </svg>
    </div>

    <!-- Reflejo decorativo abajo (inverso) -->
    <div class="header-decoration position-absolute" style="top: 216px; right: 0; transform: scaleY(-1);">
        <svg width="236" height="216" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M223.03 8 72.39 158.64" stroke="#1e2c3b" stroke-width="20" stroke-miterlimit="10"/>
            <path d="m228.681 71.99-70.64 70.64M78.64 79.74 8 150.381" stroke="#ffffff" stroke-width="20" stroke-miterlimit="10"/>
            <path d="m54.96 176.08-32.07 32.06" stroke="#3b4d61" stroke-width="20" stroke-miterlimit="10"/>
        </svg>
    </div>
</header>

<!-- Formulario superpuesto al header -->
<div class="login-wrapper d-flex justify-content-center align-items-start" style="background-color: #f8f9fa; min-height: calc(100vh - 320px);">
    <div class="card login-card border-0" style="width: 100%; max-width: 420px; margin-top: -140px; z-index: 10; border-radius: 0;">
        <div class="card-body p-4">

            <!-- Mostrar mensaje de error -->
            <?php if (!empty($message)) : ?>
                <div class="alert alert-danger fw-bold text-center" role="alert">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form action="" method="post">
    <div class="mb-4">
        <label for="uname" class="form-label fw-bold fs-5">Usuario</label>
        <input type="text" class="form-control border-0 fs-5"
            style="background-color: #2D425A; color: white; font-weight: bold; border-radius: 0;"
            id="uname" name="nombre" placeholder="Introduce tu usuario" required>
    </div>

    <div class="mb-4">
        <label for="email" class="form-label fw-bold fs-5">Email</label>
        <input type="email" class="form-control border-0 fs-5"
            style="background-color: #2D425A; color: white; font-weight: bold; border-radius: 0;"
            id="email" name="email" placeholder="Introduce tu email" required>
    </div>

    <div class="mb-4">
        <label for="pswd" class="form-label fw-bold fs-5">Contraseña</label>
        <input type="password" class="form-control border-0 fs-5"
            style="background-color: #2D425A; color: white; font-weight: bold; border-radius: 0;"
            id="pswd" name="pswd" placeholder="Introduce tu contraseña" required>
    </div>

    <button type="submit" name="registro_submit" class="btn btn-primary w-100 fw-bold fs-5" style="border-radius: 0;">
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

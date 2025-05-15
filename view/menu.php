<header class="main-page-header">
  <div class="header-row-usp">
    <div class="header-max-col">
      <div class="header-usp-swiper-container">
        <div class="js-header-usp-swiper header-usp-swiper swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
          <div class="swiper-wrapper" aria-live="polite">
            <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-active" role="group" aria-label="1 / 3" style="margin-right: 40px;">
              <div class="title-wrapper">
                <i class="bi bi-geo-alt-fill text-warning"></i>
                <span class="value">1500+ Clubs</span>
              </div>
            </div>
            <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible swiper-slide-next" role="group" aria-label="2 / 3" style="margin-right: 40px;">
              <div class="title-wrapper">
                <i class="bi bi-hammer text-warning"></i>
                <span class="value">Mejor Equipamiento</span>
              </div>
            </div>
            <div class="swiper-slide swiper-slide-visible swiper-slide-fully-visible" role="group" aria-label="3 / 3" style="margin-right: 40px;">
              <div class="title-wrapper">
                <i class="bi bi-door-open-fill text-warning"></i>
                <span class="value">Acceso a todos los Gimnasios</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="js-service-menu service-menu desktop">
        <div class="service-links-inline">

          <?php if (isset($_SESSION["nombre"])) : ?>
            <a href="index.php?controlador=miembros&action=desconectar" class="text-white fw-bold ms-auto d-flex align-items-center gap-2" style="text-decoration: none;">
              <span class="fs-6">Cerrar sesión</span>
              <i class="bi bi-x-lg fs-5"></i>
            </a>
          <?php else : ?>
            <a href="index.php?controlador=miembros&action=login" class="link-my-basicfit" target="_blank" rel="noopener">
              <i class="bi bi-person-circle"></i>
              <span>Mi cuenta FitPro</span>
            </a>
          <?php endif; ?>


          <a href="index.php?controlador=contactar&action=contactar" class="link-customer-service" target="_self" rel="noopener">
            <i class="bi bi-question-circle"></i>
            <span>Atención al cliente</span>
          </a>
        </div>
      </div>

    </div>
  </div>

  <div class="header-row-navigation">
    <div class="header-max-col">
      <div class="bf-header-logo">
        <a href="index.php" class="logo-link">
          <img src="assets/imagenes/LogoFitPro.png" class="bf-header-logo" alt="FitPro" title="FitPro">
        </a>
      </div>

      <!-- Botón Hamburguesa solo visible en móviles/tablets -->
      <button class="hamburger-btn" id="hamburger-btn" aria-label="Abrir menú">
        ☰
      </button>

      <!-- Menú principal para pantallas grandes -->
      <div class="header-navigation desktop-menu" role="navigation">
        <ul class="main-header-menu">
          <li class="main-header-menu-item dropdown">
            <a class="main-header-menu-link">
              <span class="value">Entrenamientos y consejos</span>
            </a>
            <ul class="submenu">
              <li><a href="/entrenamiento/entrenamientos">Todo sobre entrenamientos</a></li>
              <li><a href="/entrenamiento/nutricion">Todo sobre nutrición</a></li>
            </ul>
          </li>
          <li class="main-header-menu-item"><a class="main-header-menu-link" href="/entrenadores"><span class="value">Entrenadores</span></a></li>
          <li class="main-header-menu-item"><a class="main-header-menu-link" href="/comunidad"><span class="value">Comunidad</span></a></li>
          <li class="main-header-menu-item"><a class="main-header-menu-link" href="/quienessomos"><span class="value">Quienes somos</span></a></li>
        </ul>
        <a class="btn btn--secondary become-member js-become-member custom-button" href="/member">
          APÚNTATE
        </a>
      </div>

      <!-- Menú móvil hamburguesa (oculto por defecto) -->
      <nav class="mobile-menu" id="mobile-menu">
        <ul>
          <li><a href="/entrenamiento/entrenamientos">Todo sobre entrenamientos</a></li>
          <li><a href="/entrenamiento/nutricion">Todo sobre nutrición</a></li>
          <li><a href="/entrenadores">Entrenadores</a></li>
          <li><a href="/comunidad">Comunidad</a></li>
          <li><a href="/quienessomos">Quienes somos</a></li>
          <li><a href="/member" class="custom-button">APÚNTATE</a></li>
          <!-- Enlaces solo para móviles -->
          <li class="mobile-only">
            <?php if (isset($_SESSION["nombre"])) : ?>
              <a href="index.php?controlador=miembros&action=desconectar">
                <i class="bi bi-x-lg"></i> Cerrar sesión
              </a>
            <?php else : ?>
              <a href="index.php?controlador=miembros&action=login">
                <i class="bi bi-person-circle"></i> Mi cuenta FitPro
              </a>
            <?php endif; ?>
          </li>
          <li class="mobile-only">
            <a href="index.php?controlador=contactar&action=contactar">
              <i class="bi bi-question-circle"></i> Atención al cliente
            </a>
          </li>
        </ul>
      </nav>

    </div>
  </div>
</header>

<!-- Script JS para menú hamburguesa -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('hamburger-btn');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', function() {
      menu.classList.toggle('open');
    });
  });
</script>
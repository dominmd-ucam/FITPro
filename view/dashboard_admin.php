<div class="container-fluid px-2 px-lg-4" style="background-color: #111418; color: white; font-family: 'Sora', 'Noto Sans', sans-serif;">
  <!-- Botón hamburguesa visible en móvil y tablet -->
  <div class="d-block d-lg-none py-2 px-3 position-relative" style="z-index: 1060; background-color:#111418;">
    <button id="hamburgerToggle"
      class="btn position-fixed"
      style="
        top: 1rem;
        left: 1rem;
        font-size: 2.2rem;
        color: white;
        background-color: #111922;
        border: none;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
        z-index: 1050;">
      <span id="hamburgerIcon">&#9776;</span>
    </button>
  </div>

  <div class="row">
    <!-- Menú lateral fijo adaptable -->
    <nav id="mobileSidebar" class="col-12 col-lg-3 position-fixed h-100 d-lg-block d-none"
      style="background-color: #111418; overflow-y: auto; z-index: 1050; transform: translateX(-100%); transition: transform 0.3s ease-in-out; padding-top: 4rem;">
      <div class="d-flex flex-column h-100 p-3">
        <ul class="nav nav-pills flex-column mb-auto gap-2">
          <li class="nav-item">
            <a href="index.php?controlador=home&action=home" class="nav-link text-white d-flex align-items-center gap-2 bg-dark rounded">
              <i class="bi bi-house-door-fill"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a href="index.php?controlador=miembros&action=home" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-people"></i>
              Members
            </a>
          </li>
          <li>
            <a href="index.php?controlador=entrenadores&action=home" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-person"></i>
              Trainers
            </a>
          </li>
          <li>
            <a href="index.php?controlador=clases&action=home" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-people-fill"></i>
              Classes
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-file-earmark"></i>
              Reports
            </a>
          </li>
        </ul>
        <hr>
        <div class="d-flex flex-column gap-2">
          <a href="#" class="nav-link text-white d-flex align-items-center gap-2">
            <i class="bi bi-gear"></i>
            Settings
          </a>
          <a href="#" class="nav-link text-white d-flex align-items-center gap-2">
            <i class="bi bi-question-circle"></i>
            Help & Feedback
          </a>
          <a href="index.php?controlador=miembros&action=desconectar" class="nav-link text-white d-flex align-items-center gap-2">
            <i class="bi bi-box-arrow-right"></i>
            Cerrar Sesión
          </a>
        </div>
      </div>
    </nav>

    <!-- Contenido principal -->
    <div class="offset-lg-3 col-12 col-lg-9 pt-5 pt-lg-4 ps-4 pe-4">
      <div class="py-4">
        <h2 class="mb-4" style="color: white; font-size: 2rem; font-weight: bold;">Good morning, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></h2>

        <div class="row g-3">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3" style="background-color: #111922; border: none;">
              <small style="color: #8ba6c8;">Total members</small>
              <h2 style="color: #ffffff;"><?php echo $totalMembers; ?></h2>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3" style="background-color: #111922; border: none;">
              <small style="color: #8ba6c8;">Active members</small>
              <h2 style="color: #ffffff;"><?php echo $activeMembers; ?></h2>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3" style="background-color: #111922; border: none;">
              <small style="color: #8ba6c8;">Inactive members</small>
              <h2 style="color: #ffffff;"><?php echo $inactiveMembers; ?></h2>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3" style="background-color: #111922; border: none;">
              <small style="color: #8ba6c8;">Total revenue (Month)</small>
              <h2 style="color: #ffffff;">$<?php echo number_format($totalRevenue, 2); ?></h2>
            </div>
          </div>
        </div>

        <h4 class="mt-5 mb-3">Registros de Acceso</h4>
        <?php foreach ($lastAccessLogs as $log): ?>
        <div class="d-flex justify-content-between align-items-center px-3 py-2 rounded mb-2" style="background-color: #111418;">
          <div>
            <p class="mb-0" style="color: white; font-weight: 500;">
              <?php echo htmlspecialchars($log['nombre']); ?>
            </p>
            <small class="text-secondary">
              <?php 
                $fecha = new DateTime($log['fecha']);
                echo $fecha->format('d/m/Y H:i') . ' - ' . $log['codigo_qr'];
              ?>
            </small>
          </div>
          <span class="badge <?php echo $log['tipo'] == 'entrada' ? 'bg-success' : 'bg-danger'; ?> px-3 py-2">
            <?php echo $log['tipo'] == 'entrada' ? 'Entrada' : 'Salida'; ?>
          </span>
        </div>
        <?php endforeach; ?>

        <h4 class="mt-5 mb-3">Revenue this month</h4>
        <div class="card card-custom p-4">
          <!-- SVG Gráfico original -->
          <svg width="100%" height="148" viewBox="-3 0 478 150" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H326.769H0V109Z" fill="url(#paint0_linear_1131_5935)"></path>
            <path d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25" stroke="#9daab8" stroke-width="3" stroke-linecap="round"></path>
            <defs>
              <linearGradient id="paint0_linear_1131_5935" x1="236" y1="1" x2="236" y2="149" gradientUnits="userSpaceOnUse">
                <stop stop-color="#293038"></stop>
                <stop offset="1" stop-color="#293038" stop-opacity="0"></stop>
              </linearGradient>
            </defs>
          </svg>
          <!-- Fin SVG -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const toggleBtn = document.getElementById('hamburgerToggle');
const sidebar = document.getElementById('mobileSidebar');
const icon = document.getElementById('hamburgerIcon');

toggleBtn.addEventListener('click', () => {
  const isOpen = sidebar.classList.contains('show-sidebar');
  sidebar.classList.toggle('show-sidebar');
  document.body.classList.toggle('menu-open', !isOpen);
  icon.innerHTML = isOpen ? '&#9776;' : '&#10006;';
});
</script>

<style>
@media (min-width: 992px) {
  #mobileSidebar {
    transform: translateX(0) !important;
  }
}

.show-sidebar {
  transform: translateX(0%) !important;
  display: block !important;
}

#mobileSidebar {
  top: 0;
  left: 0;
  width: 75vw;
  max-width: 300px;
  height: 100vh;
  position: fixed;
  transform: translateX(-100%);
  transition: transform 0.3s ease-in-out;
  z-index: 1050;
  background-color: #111418;
}

body.menu-open {
  overflow: hidden;
}
</style>
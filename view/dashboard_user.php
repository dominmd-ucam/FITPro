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
            <a href="index.php?controlador=nutricionPlan&action=home" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-egg"></i>
              Plan de Nutrición
            </a>
          </li>
          <li>
            <a href="#" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-person"></i>
              Trainers
            </a>
          </li>
          <li>
            <a href="index.php?controlador=classShedule&action=home" class="nav-link text-white d-flex align-items-center gap-2">
              <i class="bi bi-calendar-event"></i>
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
            Help
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
            <div class="card p-4" style="background-color: #293038; border: none;">
              <p class="mb-1">Days Left</p>
              <h3 class="mb-1">45</h3>
              <p class="text-success mb-0">+5%</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-4" style="background-color: #293038; border: none;">
              <p class="mb-1">Classes Left</p>
              <h3 class="mb-1">12</h3>
              <p class="text-danger mb-0">-2%</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-4" style="background-color: #293038; border: none;">
              <p class="mb-1">Sessions</p>
              <h3 class="mb-1">30</h3>
              <p class="text-success mb-0">+3%</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-4" style="background-color: #293038; border: none;">
              <p class="mb-1">Spending Balance</p>
              <h3 class="mb-1">$150</h3>
              <p class="text-success mb-0">+1%</p>
            </div>
          </div>
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

 .card-custom,
  .card {
    background-color: #111922 !important;
    border: none;
    color: white !important;
  }

  .text-success {
    color: #0bda5b !important;
  }

  .text-danger {
    color: #fa6238 !important;
  }
</style>

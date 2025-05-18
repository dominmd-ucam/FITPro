<?php
// Verificar si hay mensajes de éxito o error
if (isset($_SESSION['mensaje'])) {
    echo '<div class="bg-green-500 text-white p-4 mb-4">' . $_SESSION['mensaje'] . '</div>';
    unset($_SESSION['mensaje']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="bg-red-500 text-white p-4 mb-4">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>FitMax - Mis Progresos</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      @media (max-width: 768px) {
        .layout-content-container {
          margin-left: 0 !important;
          width: 100%;
        }
        .sidebar {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 280px;
          height: auto;
          max-height: 90vh;
          margin: 1rem;
          z-index: 1000;
          background-color: #111418;
          border-radius: 1rem;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          overflow-y: auto;
        }
        .sidebar.active {
          display: block;
        }
        .hamburger-menu {
          display: flex !important;
          align-items: center;
          justify-content: center;
          position: fixed;
          top: 1rem;
          right: 1rem;
          z-index: 1001;
          background: #1568c1;
          padding: 0.75rem;
          border-radius: 0.5rem;
          color: white;
          width: 40px;
          height: 40px;
          cursor: pointer;
          border: none;
          box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .hamburger-menu i {
          font-size: 20px;
        }
        .overlay {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: rgba(0, 0, 0, 0.5);
          z-index: 999;
        }
        .overlay.active {
          display: block;
        }
      }
      .hamburger-menu {
        display: none;
      }
    </style>
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#111418] dark group/design-root overflow-x-hidden" style='font-family: Lexend, "Noto Sans", sans-serif;'>
      <div class="overlay" onclick="toggleSidebar()"></div>
      <button type="button" class="hamburger-menu" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </button>
      <div class="layout-container flex h-full grow flex-col">
        <div class="gap-1 px-6 flex flex-1 justify-center py-5">
          <div class="sidebar layout-content-container flex flex-col w-80 fixed left-6 top-5 bottom-5">
            <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#111418] p-4">
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl">
                    <div class="text-white" data-icon="House" data-size="24px" data-weight="fill">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=home&action=home">Dashboard</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Calendar" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM48,48H72V56a8,8,0,0,0,16,0V48h80V56a8,8,0,0,0,16,0V48h24V80H48ZM208,208H48V96H208V208Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=classShedule&action=home">Mis Clases</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Apple" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,88a8,8,0,0,0-8-8H56a8,8,0,0,0,0,16H200A8,8,0,0,0,208,88Zm-8,72H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Zm0-32H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=nutricionPlan&action=home">Plan Nutricional</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Dumbbell" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M104,40H64A16,16,0,0,0,48,56v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,80H64V56h40v64Zm88-80H152a16,16,0,0,0-16,16v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,192,40Zm0,80H152V56h40v64Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=rutina&action=home">Rutina de Entrenamiento</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#293038]">
                    <div class="text-white" data-icon="Chart" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h40A8,8,0,0,1,176,128Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=progreso&action=home">Mis Progresos</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" />
                        <path d="M7 12h10M7 12l4-4M7 12l4 4" />
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=miembros&action=desconectar">Cerrar Sesion</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1 ml-[320px]">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Mis Progresos</p>
              <button onclick="mostrarFormulario()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Registrar Nuevo Progreso
              </button>
            </div>
            
            <!-- Formulario para registrar nuevo progreso -->
            <div id="formularioProgreso" class="hidden bg-[#293038] p-6 rounded-lg mb-6">
              <form action="index.php?controlador=progreso&action=registrarProgreso" method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-white text-sm font-bold mb-2" for="peso">
                      Peso (kg)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="peso" type="number" step="0.01" name="peso" required>
                  </div>
                  <div>
                    <label class="block text-white text-sm font-bold mb-2" for="grasa_corporal">
                      Grasa Corporal (%)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="grasa_corporal" type="number" step="0.01" name="grasa_corporal" required>
                  </div>
                  <div>
                    <label class="block text-white text-sm font-bold mb-2" for="musculo">
                      Músculo (%)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="musculo" type="number" step="0.01" name="musculo" required>
                  </div>
                  <div>
                    <label class="block text-white text-sm font-bold mb-2" for="notas">
                      Notas
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                           id="notas" type="text" name="notas">
                  </div>
                </div>
                <div class="flex justify-end">
                  <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Guardar Progreso
                  </button>
                </div>
              </form>
            </div>
            
            <!-- Resumen de Estadísticas -->
            <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Resumen</h3>
            <div class="flex flex-wrap gap-4 p-4">
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Total Registros</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo $estadisticas['total_registros'] ?? 0; ?></p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Peso Actual</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo $ultimo_progreso['peso'] ?? 0; ?> kg</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Grasa Corporal</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo $ultimo_progreso['grasa_corporal'] ?? 0; ?>%</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Músculo</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo $ultimo_progreso['musculo'] ?? 0; ?>%</p>
              </div>
            </div>

            <!-- Último Progreso -->
            <?php if ($ultimo_progreso): ?>
            <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Último Registro</h3>
            <div class="flex items-center gap-4 bg-[#111418] px-4 min-h-[72px] py-2">
              <div class="text-white flex items-center justify-center rounded-lg bg-[#293038] shrink-0 size-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                  <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                </svg>
              </div>
              <div class="flex flex-col justify-center">
                <p class="text-white text-base font-medium leading-normal line-clamp-1"><?php echo date('d M, Y', strtotime($ultimo_progreso['fecha'])); ?></p>
                <p class="text-[#9daab8] text-sm font-normal leading-normal line-clamp-2">
                  Peso: <?php echo $ultimo_progreso['peso']; ?> kg · Grasa: <?php echo $ultimo_progreso['grasa_corporal']; ?>% · Músculo: <?php echo $ultimo_progreso['musculo']; ?>%
                </p>
              </div>
            </div>
            <?php endif; ?>

            <!-- Historial de Progreso -->
            <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Historial</h3>
            <?php if (!empty($progreso)): ?>
              <?php foreach ($progreso as $registro): ?>
              <div class="flex items-center gap-4 bg-[#111418] px-4 min-h-[72px] py-2">
                <div class="text-white flex items-center justify-center rounded-lg bg-[#293038] shrink-0 size-12">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                  </svg>
                </div>
                <div class="flex flex-col justify-center">
                  <p class="text-white text-base font-medium leading-normal line-clamp-1"><?php echo date('d M, Y', strtotime($registro['fecha'])); ?></p>
                  <p class="text-[#9daab8] text-sm font-normal leading-normal line-clamp-2">
                    Peso: <?php echo $registro['peso']; ?> kg · Grasa: <?php echo $registro['grasa_corporal']; ?>% · Músculo: <?php echo $registro['musculo']; ?>%
                  </p>
                  <?php if (!empty($registro['notas'])): ?>
                  <p class="text-[#9daab8] text-sm font-normal leading-normal line-clamp-2 mt-1">
                    Notas: <?php echo $registro['notas']; ?>
                  </p>
                  <?php endif; ?>
                </div>
                <form action="index.php?controlador=progreso&action=eliminarProgreso" method="POST" class="ml-auto">
                  <input type="hidden" name="progreso_id" value="<?php echo $registro['id']; ?>">
                  <button type="submit" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM80,104a8,8,0,0,1,16,0v64a8,8,0,0,1-16,0Zm80,0a8,8,0,0,1,16,0v64a8,8,0,0,1-16,0Z"></path>
                    </svg>
                  </button>
                </form>
              </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="text-center text-gray-400 py-8">
                No hay registros de progreso aún.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <script>
      function mostrarFormulario() {
        const formulario = document.getElementById('formularioProgreso');
        formulario.classList.toggle('hidden');
      }

      function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');
        if (sidebar && overlay) {
          sidebar.classList.toggle('active');
          overlay.classList.toggle('active');
        }
      }
    </script>
  </body>
</html>

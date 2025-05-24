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

    <title>FitMax - Rutina de Entrenamiento</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      @media (max-width: 768px) {
        .layout-content-container {
          margin-left: 0 !important;
          width: 100%;
        }
        .sidebar-container {
          display: none;
          position: absolute;
          top: 1rem;
          left: 1rem;
          width: 280px;
          height: auto;
          max-height: 90vh;
          z-index: 1000;
          background-color: #e7edf4;
          border-radius: 1rem;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          overflow-y: auto;
        }
        .sidebar-container.active {
          display: block;
        }
        .hamburger-menu {
          display: flex !important;
          align-items: center;
          justify-content: center;
          position: absolute;
          top: 1rem;
          right: 1rem;
          z-index: 1001;
          background: #0c77f2;
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
      
      body {
        background-color: #dce5ef;
      }
      
      .main-card {
        background-color: #f8fafc;
        border-radius: 1.5rem;
        margin: 2rem auto;
        max-width: 1600px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        position: relative;
      }
      
      .main-content {
        display: flex;
        position: relative;
        min-height: 100vh;
      }
      
      .sidebar-container {
        width: 320px;
        padding: 2rem 1rem;
        background-color: #f8fafc;
        z-index: 1000;
      }
      
      .sidebar-inner {
        background-color: #e7edf4;
        border-radius: 1rem;
        height: 100%;
        padding: 1rem;
        position: relative;
        z-index: 1000;
      }
      
      .content-container {
        flex: 1;
        padding: 2rem 1rem;
        position: relative;
      }
      
      @media (max-width: 1650px) {
        .main-card {
          margin: 1rem;
        }
      }
      
      @media (max-width: 1024px) {
        .sidebar-container {
          display: none;
        }
        
        .sidebar-container.active {
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          z-index: 1000;
        }
        
        .content-container {
          margin-left: 0;
        }
      }

      .exercise-card {
        background-color: #e7edf4;
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 1rem;
      }

      .progress-bar {
        background-color: #e7edf4;
        border-radius: 0.5rem;
        overflow: hidden;
      }

      .progress-bar-fill {
        background-color: #49709c;
        height: 0.5rem;
        border-radius: 0.5rem;
        transition: width 0.3s ease;
      }

      .form-input {
        background-color: #ffffff !important;
        color: #0d141c !important;
        border: 1px solid #49709c !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
      }

      .form-input:focus {
        border-color: #0c77f2 !important;
        box-shadow: 0 0 0 2px rgba(12, 119, 242, 0.1) !important;
      }

      .form-input::placeholder {
        color: #49709c !important;
        opacity: 0.7;
      }
    </style>
  </head>
  <body>
    <div class="main-card">
      <div class="overlay" onclick="toggleSidebar()"></div>
      <button type="button" class="hamburger-menu" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
      </button>
      
      <div class="main-content">
        <!-- Sidebar -->
        <div class="sidebar-container">
          <div class="sidebar-inner">
            <div class="flex h-full min-h-[700px] flex-col justify-between p-4">
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="House" data-size="24px" data-weight="fill">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=home&action=home">Dashboard</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Calendar" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM48,48H72v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=classShedule&action=home">Mis Clases</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Apple" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,88a8,8,0,0,0-8-8H56a8,8,0,0,0,0,16H200A8,8,0,0,0,208,88Zm-8,72H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Zm0-32H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=nutricionPlan&action=home">Plan Nutricional</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#49709c]">
                    <div class="text-white" data-icon="Dumbbell" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M104,40H64A16,16,0,0,0,48,56v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,80H64V56h40v64Zm88-80H152a16,16,0,0,0-16,16v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,192,40Zm0,80H152V56h40v64Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=rutina&action=home">Rutina de Entrenamiento</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Chart" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h40A8,8,0,0,1,176,128Z"></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=progreso&action=home">Mis Progresos</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#0d141c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" />
                        <path d="M7 12h10M7 12l4-4M7 12l4 4" />
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=miembros&action=desconectar">Cerrar Sesion</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Content -->
        <div class="content-container">
          <?php if (!isset($rutina) || !$rutina): ?>
            <div class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
              No tienes una rutina de entrenamiento asignada. Por favor, contacta con tu entrenador.
            </div>
          <?php else: ?>
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <div class="flex min-w-72 flex-col gap-3">
                <p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight"><?php echo htmlspecialchars($rutina['nombre']); ?></p>
                <p class="text-[#49709c] text-sm font-normal leading-normal"><?php echo htmlspecialchars($rutina['descripcion']); ?></p>
              </div>
            </div>

            <?php
            // Calcular progreso
            $total_ejercicios = count($ejercicios);
            $ejercicios_completados = 0;
            foreach ($progreso as $registro) {
              $ejercicios_completados++;
            }
            $porcentaje_progreso = ($total_ejercicios > 0) ? ($ejercicios_completados / $total_ejercicios) * 100 : 0;
            ?>

            <div class="flex flex-col gap-3 p-4">
              <div class="flex items-center gap-4">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Ejercicios completados</p>
                <div class="progress-bar h-1.5 w-[200px]">
                  <div class="progress-bar-fill" style="width: <?php echo $porcentaje_progreso; ?>%;"></div>
                </div>
              </div>
            </div>

            <?php foreach ($ejercicios as $ejercicio): ?>
              <div class="exercise-card">
                <div class="flex flex-col justify-center">
                  <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($ejercicio['nombre']); ?></p>
                  <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                    <?php echo $ejercicio['series']; ?> series, <?php echo $ejercicio['repeticiones']; ?> repeticiones
                  </p>
                </div>

                <form action="index.php?controlador=rutina&action=registrar_progreso" method="POST" class="flex flex-col gap-4 mt-4">
                  <input type="hidden" name="ejercicio_id" value="<?php echo $ejercicio['id']; ?>">
                  <input type="hidden" name="rutina_id" value="<?php echo $rutina['id']; ?>">
                  
                  <div class="flex max-w-[480px] flex-wrap items-end gap-4">
                    <label class="flex flex-col min-w-40 flex-1">
                      <input
                        type="number"
                        name="peso"
                        placeholder="Peso (kg)"
                        required
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl focus:outline-0 focus:ring-0 border-none focus:border-none h-14 p-4 text-base font-normal leading-normal"
                      />
                    </label>
                    <label class="flex flex-col min-w-40 flex-1">
                      <input
                        type="number"
                        name="repeticiones"
                        placeholder="Repeticiones"
                        required
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl focus:outline-0 focus:ring-0 border-none focus:border-none h-14 p-4 text-base font-normal leading-normal"
                      />
                    </label>
                  </div>
                  <div class="flex justify-end">
                    <button type="submit" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#49709c] hover:bg-[#0c77f2] transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em]">
                      <span class="truncate">Registrar Resultado</span>
                    </button>
                  </div>
                </form>
              </div>
            <?php endforeach; ?>

            <?php if (!empty($progreso)): ?>
              <h3 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Historial de Progreso</h3>
              <?php foreach ($progreso as $registro): ?>
                <div class="exercise-card">
                  <div class="flex flex-col justify-center">
                    <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($registro['nombre']); ?></p>
                    <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                      <?php echo date('d/m/Y', strtotime($registro['fecha'])); ?> - 
                      Peso: <?php echo $registro['peso']; ?> kg | 
                      Reps: <?php echo $registro['repeticiones']; ?>
                    </p>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <script>
      function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar-container');
        const overlay = document.querySelector('.overlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
      }

      // Cerrar el menú al hacer click en un enlace
      document.querySelectorAll('.sidebar-container a').forEach(link => {
        link.addEventListener('click', () => {
          const sidebar = document.querySelector('.sidebar-container');
          const overlay = document.querySelector('.overlay');
          if (window.innerWidth <= 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
          }
        });
      });
    </script>
  </body>
</html>

<?php
require_once("controller/front_controller.php");

// Verificar si el usuario está logueado
if (!verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
  <link
    rel="stylesheet"
    as="style"
    onload="this.rel='stylesheet'"
    href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

  <title>Agenda de Clases</title>
  <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script defer src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
  
  <style>
    /* Ocultar elementos con x-cloak hasta que Alpine.js esté listo */
    [x-cloak] {
      display: none !important;
    }

    /* Asegurar que SweetAlert2 aparezca por encima del modal */
    .swal2-container {
      z-index: 10000 !important;
    }
  </style>
  
  <script>
    // Verificar que todo esté cargado correctamente
    document.addEventListener('DOMContentLoaded', () => {
      console.log('DOM cargado completamente');
      
      // Verificar que Alpine.js esté disponible
      if (typeof Alpine !== 'undefined') {
        console.log('Alpine.js está disponible');
      } else {
        console.error('Alpine.js no está disponible - volviendo a cargar');
        // Intentar cargar Alpine.js de nuevo si no está disponible
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js';
        document.head.appendChild(script);
      }
    });
  </script>

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
        z-index: 998;
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
        z-index: 997;
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

    /* Estilos para el calendario */
    .calendar-container {
      background-color: #f8fafc;
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }
    
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }
    
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 0.5rem;
    }
    
    .calendar-day {
      background-color: #e7edf4;
      border-radius: 0.5rem;
      padding: 0.5rem;
      min-height: 100px;
      color: #0d141c;
    }
    
    .calendar-day-header {
      text-align: center;
      font-weight: bold;
      color: #49709c;
      padding: 0.5rem;
    }
    
    .calendar-event {
      background-color: #49709c;
      border-radius: 0.25rem;
      padding: 0.25rem;
      margin: 0.25rem 0;
      font-size: 0.875rem;
      color: white;
    }
    
    .calendar-today {
      background-color: #0c77f2;
      color: white;
    }
    
    .calendar-nav-button {
      background-color: #49709c;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
    }
    
    .calendar-nav-button:hover {
      background-color: #0c77f2;
    }

    .class-card {
      background-color: #e7edf4;
      border-radius: 1rem;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .class-title {
      color: #0d141c;
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .class-time {
      color: #49709c;
      font-size: 0.875rem;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.8);
    }
    
    .modal.active {
      display: block;
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
                <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#49709c]">
                  <div class="text-white" data-icon="Calendar" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM48,48H72V56a8,8,0,0,0,16,0V48h80V56a8,8,0,0,0,16,0V48h24V80H48ZM208,208H48V96H208V208Z"></path>
                    </svg>
                  </div>
                  <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=classShedule&action=home">Mis Clases</a>
                </div>
                <div class="flex items-center gap-3 px-3 py-2">
                  <div class="text-[#0d141c]" data-icon="Apple" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M208,88a8,8,0,0,0-8-8H56a8,8,0,0,0,0,16H200A8,8,0,0,0,208,88Zm-8,72H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Zm0-32H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Z"></path>
                    </svg>
                  </div>
                  <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=nutricionPlan&action=home">Plan Nutricional</a>
                </div>
                <div class="flex items-center gap-3 px-3 py-2">
                  <div class="text-[#0d141c]" data-icon="Dumbbell" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M104,40H64A16,16,0,0,0,48,56v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,80H64V56h40v64Zm88-80H152a16,16,0,0,0-16,16v64a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A16,16,0,0,0,192,40Zm0,80H152V56h40v64Z"></path>
                    </svg>
                  </div>
                  <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=rutina&action=home">Rutina de Entrenamiento</a>
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
              <div class="flex flex-wrap justify-between gap-3 p-4">
          <p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight min-w-72">Calendario de Clases</p>
              </div>

              <!-- Calendario -->
        <div class="calendar-container">
          <div id="calendar">
            <div class="bg-white rounded-lg shadow overflow-hidden">
              <div class="flex items-center justify-between py-2 px-6">
                <div>
                  <span id="month-name" class="text-lg font-bold text-gray-800"></span>
                  <span id="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                </div>
                <div class="flex items-center gap-4">
                  <button 
                    type="button"
                    onclick="toggleInscripciones()"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition ease-in-out duration-100">
                    Mis Inscripciones
                  </button>
                  <div class="border rounded-lg px-1" style="padding-top: 2px;">
                    <button 
                      type="button"
                      id="prev-month"
                      class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center">
                      <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                      </svg>  
                    </button>
                    <div class="border-r inline-flex h-6"></div>		
                    <button 
                      type="button"
                      id="next-month"
                      class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1">
                      <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                      </svg>									  
                    </button>
                  </div>
                </div>
              </div>	

              <div class="-mx-1 -mb-1">
                <div class="flex flex-wrap" style="margin-bottom: -40px;">
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Dom</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Lun</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Mar</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Mié</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Jue</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Vie</div>
                  </div>
                  <div class="w-[14.26%] px-2 py-2">
                    <div class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">Sáb</div>
                  </div>
                </div>

                <div id="calendar-grid" class="flex flex-wrap border-t border-l">
                  <!-- Los días se generarán dinámicamente aquí -->
                </div>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div id="eventModal" class="modal">
            <div class="p-4 max-w-4xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
              <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                onclick="closeModal()">
                <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                </svg>
              </div>

              <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
                <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Mis Inscripciones</h2>
                <div class="mb-4">
                  <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                      <thead>
                        <tr class="bg-gray-100">
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clase</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Día</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horario</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrenador</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                        <?php foreach ($inscripciones as $inscripcion): ?>
                          <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-900"><?php echo htmlspecialchars($inscripcion['nombre_clase']); ?></td>
                            <td class="px-4 py-2 text-sm text-gray-900"><?php echo htmlspecialchars($inscripcion['dia_semana']); ?></td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                              <?php 
                                $hora_inicio = date('g:i A', strtotime($inscripcion['hora_inicio']));
                                $hora_fin = date('g:i A', strtotime($inscripcion['hora_fin']));
                                echo htmlspecialchars($hora_inicio . ' - ' . $hora_fin);
                              ?>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-900"><?php echo htmlspecialchars($inscripcion['nombre_entrenador']); ?></td>
                            <td class="px-4 py-2 text-sm text-gray-900">
                              <button onclick="anularInscripcion(<?php echo $inscripcion['id']; ?>)" 
                                      class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-lg text-sm">
                                Anular
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mt-8 text-right">
                  <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm" onclick="closeModal()">Cerrar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal para Añadir Clase -->
          <div id="addClassModal" class="modal">
            <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
              <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                onclick="closeAddClassModal()">
                <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                </svg>
              </div>

              <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
                <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Añadir Clase</h2>
                <div class="mb-4">
                  <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                      <thead>
                        <tr class="bg-gray-100">
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clase</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horario</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrenador</th>
                          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200" id="availableClasses">
                        <!-- Las clases disponibles se cargarán dinámicamente -->
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="mt-8 text-right">
                  <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm" onclick="closeAddClassModal()">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h3 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Hoy</h3>
        <div class="flex flex-col gap-2 px-4 rounded-xl bg-[#e7edf4] p-4">
                <?php 
                // Obtener el día actual en español
                $dias = array(
                    'Monday' => 'Lunes',
                    'Tuesday' => 'Martes',
                    'Wednesday' => 'Miércoles',
                    'Thursday' => 'Jueves',
                    'Friday' => 'Viernes',
                    'Saturday' => 'Sábado',
                    'Sunday' => 'Domingo'
                );
                $dia_actual = $dias[date('l')];
                
                // Consulta para obtener las clases de hoy
                $sql = "SELECT c.nombre, h.hora_inicio, h.hora_fin, h.dia_semana 
                        FROM inscripciones i 
                        JOIN clases c ON i.clase_id = c.id 
                        JOIN horarios h ON i.horario_id = h.id 
                        WHERE i.usuario_id = ? 
                        AND h.dia_semana = ? 
                        AND i.fecha_inscripcion = CURDATE()";
                
                $stmt = $datos->db->prepare($sql);
                $stmt->bind_param("is", $usuario_id, $dia_actual);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $clases_hoy = array();
                
                while($row = $resultado->fetch_assoc()) {
                    $clases_hoy[] = $row;
                }
                
                if (empty($clases_hoy)): ?>
                    <p class="text-[#0d141c] text-center py-4">No tienes clases programadas para hoy</p>
                <?php else: 
                    foreach ($clases_hoy as $clase): ?>
                        <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                                style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                            <div class="flex flex-col justify-center">
                                <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                                <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                                    <?php 
                                        $hora_inicio = date('g:i A', strtotime($clase['hora_inicio']));
                                        $hora_fin = date('g:i A', strtotime($clase['hora_fin']));
                                        echo htmlspecialchars($clase['dia_semana'] . ', ' . $hora_inicio . ' - ' . $hora_fin);
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
        </div>

        <h3 class="text-[#0d141c] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Proximas</h3>
        <div class="flex flex-col gap-2 px-4 rounded-xl bg-[#e7edf4] p-4">
                <?php 
                // Obtener el día actual en español
                $dias = array(
                    'Monday' => 'Lunes',
                    'Tuesday' => 'Martes',
                    'Wednesday' => 'Miércoles',
                    'Thursday' => 'Jueves',
                    'Friday' => 'Viernes',
                    'Saturday' => 'Sábado',
                    'Sunday' => 'Domingo'
                );
                $dia_actual = $dias[date('l')];
                
                // Consulta para obtener las próximas clases
                $sql = "SELECT DISTINCT c.nombre, h.hora_inicio, h.hora_fin, h.dia_semana, i.fecha_inscripcion 
                        FROM inscripciones i 
                        JOIN clases c ON i.clase_id = c.id 
                        JOIN horarios h ON i.horario_id = h.id 
                        WHERE i.usuario_id = ? 
                        AND i.fecha_inscripcion > CURDATE()
                        ORDER BY i.fecha_inscripcion ASC, h.hora_inicio ASC";
                
                $stmt = $datos->db->prepare($sql);
                $stmt->bind_param("i", $usuario_id);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $proximas_clases = array();
                
                while($row = $resultado->fetch_assoc()) {
                    $proximas_clases[] = $row;
                }
                
                if (empty($proximas_clases)): ?>
                    <p class="text-[#0d141c] text-center py-4">No tienes próximas clases programadas</p>
                <?php else: 
                    foreach ($proximas_clases as $clase): ?>
                        <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                                style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                            <div class="flex flex-col justify-center">
                                <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                                <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                                    <?php 
                                        $hora_inicio = date('g:i A', strtotime($clase['hora_inicio']));
                                        $hora_fin = date('g:i A', strtotime($clase['hora_fin']));
                                        echo htmlspecialchars($clase['dia_semana'] . ', ' . $hora_inicio . ' - ' . $hora_fin);
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach;
                endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    const MONTH_NAMES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let events = [
      <?php 
      // Obtener todas las inscripciones del usuario
      $sql = "SELECT i.fecha_inscripcion, c.nombre, c.id as clase_id, h.hora_inicio, h.hora_fin 
              FROM inscripciones i 
              JOIN clases c ON i.clase_id = c.id 
              JOIN horarios h ON i.horario_id = h.id 
              WHERE i.usuario_id = ?";
      
      $stmt = $datos->db->prepare($sql);
      $stmt->bind_param("i", $usuario_id);
      $stmt->execute();
      $resultado = $stmt->get_result();
      
      $eventos_generados = array();
      
      while ($inscripcion = $resultado->fetch_assoc()) {
        if ($inscripcion['fecha_inscripcion']) {
          $fecha = $inscripcion['fecha_inscripcion'];
          $hora_inicio = date('H:i', strtotime($inscripcion['hora_inicio']));
          $hora_fin = date('H:i', strtotime($inscripcion['hora_fin']));
          
          $evento_key = $inscripcion['nombre'] . '_' . $fecha . '_' . $hora_inicio;
          
          if (!in_array($evento_key, $eventos_generados)) {
            $eventos_generados[] = $evento_key;
            
            echo "{
              date: new Date('" . $fecha . "'),
              title: '" . addslashes($inscripcion['nombre']) . " (" . $hora_inicio . "-" . $hora_fin . ")',
              theme: 'blue'
            },";
          }
        }
      }
      ?>
    ];

    function initCalendar() {
      updateCalendarHeader();
      generateCalendar();
      setupEventListeners();
    }

    function updateCalendarHeader() {
      document.getElementById('month-name').textContent = MONTH_NAMES[currentMonth];
      document.getElementById('year').textContent = currentYear;
    }

    function generateCalendar() {
      const calendarGrid = document.getElementById('calendar-grid');
      calendarGrid.innerHTML = '';

      const firstDay = new Date(currentYear, currentMonth, 1);
      const lastDay = new Date(currentYear, currentMonth + 1, 0);
      const startingDay = firstDay.getDay();
      const totalDays = lastDay.getDate();

      // Agregar días en blanco al inicio
      for (let i = 0; i < startingDay; i++) {
        const blankDay = document.createElement('div');
        blankDay.className = 'w-[14.28%] h-[120px] text-center border-r border-b px-4 pt-2';
        calendarGrid.appendChild(blankDay);
      }

      // Agregar los días del mes
      for (let day = 1; day <= totalDays; day++) {
        const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayElement = document.createElement('div');
        dayElement.className = 'w-[14.28%] h-[120px] px-4 pt-2 border-r border-b relative cursor-pointer';
        dayElement.id = `day-${formattedDate}`;
        dayElement.setAttribute('data-date', formattedDate);
        dayElement.setAttribute('onclick', `openModalForDate(${day})`);
        
        const dayNumber = document.createElement('div');
        dayNumber.className = 'inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100';
        dayNumber.textContent = day;
        
        if (isToday(day)) {
          dayNumber.classList.add('bg-blue-500', 'text-white');
        } else {
          dayNumber.classList.add('text-gray-700');
        }
        
        const eventsContainer = document.createElement('div');
        eventsContainer.className = 'h-[80px] overflow-y-auto mt-1';
        eventsContainer.id = `events-${formattedDate}`;
        
        // Filtrar las inscripciones para este día
        const dayEvents = events.filter(event => {
          const eventDate = new Date(event.date);
          const eventFormattedDate = `${eventDate.getFullYear()}-${String(eventDate.getMonth() + 1).padStart(2, '0')}-${String(eventDate.getDate()).padStart(2, '0')}`;
          return eventFormattedDate === formattedDate;
        });

        // Ordenar eventos por hora
        dayEvents.sort((a, b) => {
          const timeA = a.title.match(/(\d{2}:\d{2})/)[0];
          const timeB = b.title.match(/(\d{2}:\d{2})/)[0];
          return timeA.localeCompare(timeB);
        });

        dayEvents.forEach(event => {
          const eventElement = document.createElement('div');
          eventElement.className = 'px-2 py-1 rounded-lg mt-1 overflow-hidden border border-blue-200 text-blue-800 bg-blue-100';
          eventElement.textContent = event.title;
          eventsContainer.appendChild(eventElement);
        });
        
        dayElement.appendChild(dayNumber);
        dayElement.appendChild(eventsContainer);
        calendarGrid.appendChild(dayElement);
      }
    }

    function isToday(day) {
      const today = new Date();
      return day === today.getDate() && 
             currentMonth === today.getMonth() && 
             currentYear === today.getFullYear();
    }

    function getEventsForDate(day) {
      const date = new Date(currentYear, currentMonth, day);
      return events.filter(event => {
        const eventDate = new Date(event.date);
        return eventDate.getDate() === date.getDate() &&
               eventDate.getMonth() === date.getMonth() &&
               eventDate.getFullYear() === date.getFullYear();
      });
    }

    function toggleInscripciones() {
      document.getElementById('eventModal').classList.toggle('active');
    }

    function closeModal() {
      document.getElementById('eventModal').classList.remove('active');
    }

    function setupEventListeners() {
      document.getElementById('prev-month').onclick = () => {
        if (currentMonth === 0) {
          currentMonth = 11;
          currentYear--;
        } else {
          currentMonth--;
        }
        updateCalendarHeader();
        generateCalendar();
      };

      document.getElementById('next-month').onclick = () => {
        if (currentMonth === 11) {
          currentMonth = 0;
          currentYear++;
        } else {
          currentMonth++;
        }
        updateCalendarHeader();
        generateCalendar();
      };
    }

    // Inicializar el calendario cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', initCalendar);

    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar-container');
      const overlay = document.querySelector('.overlay');
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');
    }

    function openModalForDate(day) {
      // Crear la fecha directamente con el formato YYYY-MM-DD
      const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
      const selectedDate = new Date(currentYear, currentMonth, day);
      const dayOfWeek = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'][selectedDate.getDay()];
      
      // Guardar la fecha seleccionada en un atributo data del modal
      const modal = document.getElementById('addClassModal');
      modal.setAttribute('data-selected-date', formattedDate);
      
      // Cargar las clases disponibles para ese día
      fetch(`view/get_available_classes.php?dia=${dayOfWeek}&fecha=${formattedDate}`)
        .then(response => response.json())
        .then(data => {
          const tbody = document.getElementById('availableClasses');
          tbody.innerHTML = '';
          
          if (data.error) {
            tbody.innerHTML = `<tr><td colspan="4" class="px-4 py-2 text-sm text-gray-900 text-center">${data.error}</td></tr>`;
          } else if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4" class="px-4 py-2 text-sm text-gray-900 text-center">No hay clases disponibles para este día</td></tr>`;
          } else {
            data.forEach(clase => {
              const row = document.createElement('tr');
              row.className = 'hover:bg-gray-50';
              row.innerHTML = `
                <td class="px-4 py-2 text-sm text-gray-900">${clase.nombre}</td>
                <td class="px-4 py-2 text-sm text-gray-900">
                  ${new Date('1970-01-01T' + clase.hora_inicio).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})} - 
                  ${new Date('1970-01-01T' + clase.hora_fin).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})}
                </td>
                <td class="px-4 py-2 text-sm text-gray-900">${clase.nombre_entrenador}</td>
                <td class="px-4 py-2 text-sm text-gray-900">
                  <button onclick="inscribirseClase(${clase.id})" 
                          class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded-lg text-sm">
                    Inscribirse
                  </button>
                </td>
              `;
              tbody.appendChild(row);
            });
          }
          
          modal.classList.add('active');
        })
        .catch(error => {
          console.error('Error:', error);
          const tbody = document.getElementById('availableClasses');
          tbody.innerHTML = `<tr><td colspan="4" class="px-4 py-2 text-sm text-gray-900 text-center">Error al cargar las clases</td></tr>`;
          document.getElementById('addClassModal').classList.add('active');
        });
    }

    function closeAddClassModal() {
      document.getElementById('addClassModal').classList.remove('active');
    }

    function inscribirseClase(claseId) {
      const modal = document.getElementById('addClassModal');
      const fechaSeleccionada = modal.getAttribute('data-selected-date');
      console.log('Fecha seleccionada:', fechaSeleccionada);
      console.log('Clase ID:', claseId);
      
      fetch('view/inscribirse_clase.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          clase_id: claseId,
          fecha: fechaSeleccionada
        })
      })
      .then(response => response.json())
      .then(data => {
        console.log('Respuesta del servidor:', data);
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: data.message,
            confirmButtonColor: '#0c77f2'
          });
          closeAddClassModal();
          
          // Crear el nuevo evento
          const nuevoEvento = {
            date: new Date(fechaSeleccionada),
            title: `${data.clase_nombre} (${data.hora_inicio}-${data.hora_fin})`,
            theme: 'blue'
          };
          
          // Añadir el evento al array de eventos
          events.push(nuevoEvento);
          
          // Actualizar el calendario
          generateCalendar();
          
          // Actualizar la sección de clases de hoy
          actualizarClasesHoy();
          
          // Actualizar la sección de próximas clases
          actualizarProximasClases();

          // Recargar la página para actualizar el modal de inscripciones
          window.location.reload();
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message || 'Error al inscribirse en la clase',
            confirmButtonColor: '#0c77f2'
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Error al inscribirse en la clase',
          confirmButtonColor: '#0c77f2'
        });
      });
    }

    // Función para actualizar la sección de clases de hoy
    function actualizarClasesHoy() {
      fetch('view/get_available_classes.php?dia=' + getDiaActual() + '&fecha=' + new Date().toISOString().split('T')[0])
        .then(response => response.json())
        .then(data => {
          const contenedorClasesHoy = document.querySelector('.flex.flex-col.gap-2.px-4.rounded-xl.bg-\\[\\#e7edf4\\].p-4');
          if (data.length === 0) {
            contenedorClasesHoy.innerHTML = '<p class="text-[#0d141c] text-center py-4">No tienes clases programadas para hoy</p>';
          } else {
            let html = '';
            data.forEach(clase => {
              html += `
                <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                  <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                      style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                  <div class="flex flex-col justify-center">
                    <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1">${clase.nombre}</p>
                    <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                      ${clase.dia_semana}, ${new Date('1970-01-01T' + clase.hora_inicio).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})} - 
                      ${new Date('1970-01-01T' + clase.hora_fin).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})}
                    </p>
                  </div>
                </div>
              `;
            });
            contenedorClasesHoy.innerHTML = html;
          }
        })
        .catch(error => console.error('Error al actualizar clases de hoy:', error));
    }

    // Función para actualizar la sección de próximas clases
    function actualizarProximasClases() {
      fetch('view/get_available_classes.php?dia=' + getDiaActual() + '&fecha=' + new Date().toISOString().split('T')[0])
        .then(response => response.json())
        .then(data => {
          const contenedorProximasClases = document.querySelectorAll('.flex.flex-col.gap-2.px-4.rounded-xl.bg-\\[\\#e7edf4\\].p-4')[1];
          if (data.length === 0) {
            contenedorProximasClases.innerHTML = '<p class="text-[#0d141c] text-center py-4">No tienes próximas clases programadas</p>';
          } else {
            let html = '';
            data.forEach(clase => {
              html += `
                <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                  <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                      style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                  <div class="flex flex-col justify-center">
                    <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1">${clase.nombre}</p>
                    <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                      ${clase.dia_semana}, ${new Date('1970-01-01T' + clase.hora_inicio).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})} - 
                      ${new Date('1970-01-01T' + clase.hora_fin).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})}
                    </p>
                  </div>
                </div>
              `;
            });
            contenedorProximasClases.innerHTML = html;
          }
        })
        .catch(error => console.error('Error al actualizar próximas clases:', error));
    }

    // Función auxiliar para obtener el día actual en español
    function getDiaActual() {
      const dias = {
        'Monday': 'Lunes',
        'Tuesday': 'Martes',
        'Wednesday': 'Miércoles',
        'Thursday': 'Jueves',
        'Friday': 'Viernes',
        'Saturday': 'Sábado',
        'Sunday': 'Domingo'
      };
      return dias[new Date().toLocaleDateString('en-US', { weekday: 'long' })];
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

    // Función para anular una inscripción
    function anularInscripcion(inscripcionId) {
      Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, anular inscripción',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Mostrar indicador de carga
          Swal.fire({
            title: 'Procesando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });

          fetch('view/anular_inscripcion.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({
              inscripcion_id: inscripcionId
            })
          })
          .then(response => {
            if (!response.ok) {
              throw new Error('Error en la respuesta del servidor');
            }
            return response.text().then(text => {
              try {
                return JSON.parse(text);
              } catch (e) {
                console.error('Error al parsear JSON:', text);
                throw new Error('Respuesta inválida del servidor');
              }
            });
          })
          .then(data => {
            console.log('Respuesta del servidor:', data);
            if (data.success) {
              Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: data.message,
                confirmButtonColor: '#0c77f2'
              });
              
              // Actualizar el calendario
              actualizarCalendario();
              
              // Actualizar la sección de clases de hoy
              actualizarClasesHoy();
              
              // Actualizar la sección de próximas clases
              actualizarProximasClases();
              
              // Cerrar el modal de inscripciones
              closeModal();
            } else {
              throw new Error(data.message || 'Error al anular la inscripción');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: error.message || 'Error al anular la inscripción',
              confirmButtonColor: '#0c77f2'
            });
          });
        }
      });
    }

    // Función para actualizar el calendario
    function actualizarCalendario() {
      // Recargar la página para actualizar el calendario
      window.location.reload();
    }
  </script>

<!-- Chatbot Integration -->
<button
  class="fixed bottom-4 right-4 inline-flex items-center justify-center text-sm font-medium disabled:pointer-events-none disabled:opacity-50 border rounded-full w-16 h-16 bg-black hover:bg-gray-700 m-0 cursor-pointer border-gray-200 bg-none p-0 normal-case leading-5 hover:text-gray-900"
  type="button" aria-haspopup="dialog" aria-expanded="false" data-state="closed" id="chatToggle">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white block border-gray-200 align-middle">
    <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" class="border-gray-200">
    </path>
  </svg>
</button>

<div style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05);"
  class="fixed bottom-[calc(4rem+1.5rem)] right-0 mr-4 bg-white p-6 rounded-lg border border-[#e5e7eb] w-[440px] h-[634px] flex flex-col hidden" id="chatContainer">

  <!-- Heading -->
  <div class="flex flex-col space-y-1.5 pb-6">
    <h2 class="font-semibold text-lg tracking-tight text-gray-900">Chatbot</h2>
    <p class="text-sm text-[#6b7280] leading-3">Powered by Gemini-2.0-flash</p>
  </div>

  <!-- Chat Container -->
  <div class="flex-1 overflow-y-auto pr-2">
    <!-- Chat Message AI -->
    <div class="flex gap-3 my-4 text-gray-600 text-sm">
      <span class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
        <div class="rounded-full bg-gray-100 border p-1">
          <svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"></path>
          </svg>
        </div>
      </span>
      <p class="leading-relaxed break-words flex-1"><span class="block font-bold text-gray-700">AI </span>¡Hola! Soy tu asistente virtual para el gimnasio. ¿En qué puedo ayudarte hoy?</p>
    </div>
  </div>
  <!-- Input box  -->
  <div class="flex items-center pt-4 mt-auto">
    <form class="flex items-center justify-center w-full space-x-2">
      <input
        class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-[#9ca3af] disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
        placeholder="Type your message" value="">
      <button
        class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-black hover:bg-[#111827E6] h-10 px-4 py-2">
        Send</button>
    </form>
  </div>
</div>

<script>
  const chatToggle = document.getElementById('chatToggle');
  const chatContainer = document.getElementById('chatContainer');
  const chatInput = document.querySelector('input[placeholder="Type your message"]');
  const sendChatBtn = document.querySelector('button:last-child');
  const chatMessagesContainer = document.querySelector('.flex-1.overflow-y-auto');
  let messages = [
      { role: "system", content: "You are a helpful assistant for a gym website." }
  ];

  // Función para alternar la visibilidad del chat
  chatToggle.addEventListener('click', () => {
      const isHidden = chatContainer.classList.contains('hidden');
      chatContainer.classList.toggle('hidden');
      chatToggle.setAttribute('aria-expanded', !isHidden);
      chatToggle.setAttribute('data-state', isHidden ? 'open' : 'closed');
  });

  // Verificar que los elementos existan
  if (!chatInput || !sendChatBtn || !chatMessagesContainer) {
      console.error('No se pudieron encontrar los elementos necesarios del chat');
  }

  const createChatMessage = (message, isUser = false) => {
      const messageDiv = document.createElement('div');
      messageDiv.className = 'flex gap-3 my-4 text-gray-600 text-sm';
      
      const iconSpan = document.createElement('span');
      iconSpan.className = 'relative flex shrink-0 overflow-hidden rounded-full w-8 h-8';
      
      const iconDiv = document.createElement('div');
      iconDiv.className = 'rounded-full bg-gray-100 border p-1';
      
      // Icono SVG según si es usuario o AI
      iconDiv.innerHTML = isUser ? 
          `<svg stroke="none" fill="black" stroke-width="0" viewBox="0 0 16 16" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
          </svg>` :
          `<svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"></path>
          </svg>`;
      
      iconSpan.appendChild(iconDiv);
      
      const messageP = document.createElement('p');
      messageP.className = 'leading-relaxed break-words flex-1';
      messageP.innerHTML = `<span class="block font-bold text-gray-700">${isUser ? 'You' : 'AI'}</span>${message}`;
      
      messageDiv.appendChild(iconSpan);
      messageDiv.appendChild(messageP);
      
      return messageDiv;
  };

  const generateResponse = (userMessage) => {
      if (!chatMessagesContainer) return;
      
      const thinkingMessage = createChatMessage('Thinking...', false);
      chatMessagesContainer.appendChild(thinkingMessage);
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

      fetch("controller/chatbot.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ messages: messages })
      })
      .then(res => {
          if (!res.ok) throw new Error("Network error");
          return res.json();
      })
      .then(data => {
          const reply = data.choices[0].message.content;
          thinkingMessage.remove();
          chatMessagesContainer.appendChild(createChatMessage(reply, false));
          chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
          messages.push({ role: "assistant", content: reply });
      })
      .catch(() => {
          thinkingMessage.remove();
          chatMessagesContainer.appendChild(createChatMessage("Oops! Something went wrong. Please try again!", false));
          chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
      });
  };

  const handleChat = () => {
      if (!chatInput || !chatMessagesContainer) return;
      
      const userMessage = chatInput.value.trim();
      if (!userMessage) return;

      messages.push({ role: "user", content: userMessage });
      chatMessagesContainer.appendChild(createChatMessage(userMessage, true));
      chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
      chatInput.value = "";
      generateResponse(userMessage);
  };

  if (sendChatBtn) {
      sendChatBtn.addEventListener("click", handleChat);
  }
  
  if (chatInput) {
      chatInput.addEventListener("keypress", function (e) {
          if (e.key === "Enter" && !e.shiftKey) {
              e.preventDefault();
              handleChat();
          }
      });
  }
</script>

</body>

</html>
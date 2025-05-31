<?php
require_once("controller/front_controller.php");

// Verificar si el usuario está logueado
if (!verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}

// Verificar si hay un plan nutricional
if (!isset($plan_nutricional) || empty($plan_nutricional)) {
    $no_plan = true;
} else {
    $no_plan = false;
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

    <title>Plan Nutricional - GymTrack</title>
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

      .stats-card {
        background-color: #e7edf4;
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid #49709c;
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

      .checkbox-custom {
        border-color: #49709c;
      }

      .checkbox-custom:checked {
        background-color: #49709c;
        border-color: #49709c;
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
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#49709c]">
                    <div class="text-white" data-icon="Apple" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,88a8,8,0,0,0-8-8H56a8,8,0,0,0,0,16H200A8,8,0,0,0,208,88Zm-8,72H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Zm0-32H56a8,8,0,0,0,0,16H200a8,8,0,0,0,0-16Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=nutricionPlan&action=home">Plan Nutricional</a>
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
          <?php if ($no_plan): ?>
            <div class="text-center p-8">
              <h2 class="text-[#0d141c] text-2xl font-bold mb-4">No tienes un plan nutricional activo</h2>
              <p class="text-[#49709c] mb-4">Contacta con un entrenador para obtener un plan personalizado</p>
              <a href="index.php?controlador=contactar&action=contacto" class="inline-block bg-[#49709c] text-white px-6 py-2 rounded-xl hover:bg-[#0c77f2] transition-colors">Contactar Entrenador</a>
            </div>
          <?php else: ?>
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <div class="flex min-w-72 flex-col gap-3">
                <p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight">Tu plan nutricional</p>
                <p class="text-[#49709c] text-sm font-normal leading-normal">Inicio: <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_inicio'])); ?></p>
              </div>
            </div>
            <div class="flex flex-wrap gap-4 p-4">
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 stats-card">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Calorías</p>
                <p class="text-[#0d141c] tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_calorias']); ?></p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 stats-card">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Proteínas</p>
                <p class="text-[#0d141c] tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_proteinas']); ?>g</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 stats-card">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Carbohidratos</p>
                <p class="text-[#0d141c] tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_carbohidratos']); ?>g</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 stats-card">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Grasas</p>
                <p class="text-[#0d141c] tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_grasas']); ?>g</p>
              </div>
            </div>
            <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Plan Semanal</h2>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <?php
              $dias_semana = [
                'Lunes' => 'https://travelingua.es/wp-content/uploads/2023/11/comida-tipica-canada.jpg',
                'Martes' => 'https://sophiederam.com/wp-content/uploads/2022/05/alimentos-saudaveis-para-o-almoco.png',
                'Miercoles' => 'https://cdn.businessinsider.es/sites/navi.axelspringer.es/public/media/image/2023/04/plato-harvard-3006638.jpg?tf=3840x',
                'Jueves' => 'https://xurrosymas.mx/wp-content/uploads/2024/08/comida-saludable-1024x675.jpg',
                'Viernes' => 'https://www.clarin.com/2024/08/18/GwjPHUqMQ_2000x1500__1.jpg',
                'Sabado' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/44/72/cf/aprende-a-cocinar-comida.jpg',
                'Domingo' => 'https://cdn-3.expansion.mx/dims4/default/dc6563f/2147483647/strip/true/crop/1253x658+0+89/resize/1200x630!/format/jpg/quality/80/?url=https%3A%2F%2Fcdn-3.expansion.mx%2Fa9%2F68%2F255e44db4bc1be07dcc0b495e5ef%2Ftacos-comida-callejera-mexico.jpg'
              ];
              foreach ($dias_semana as $dia => $imagen) {
                  $comidas_dia = array_filter($dieta_diaria, function($comida) use ($dia) {
                      return $comida['dia_semana'] === $dia;
                  });
              ?>
              <div class="flex flex-col gap-3 pb-3">
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl" style="background-image: url('<?php echo $imagen; ?>');"></div>
                <div>
                  <p class="text-[#0d141c] text-base font-medium leading-normal"><?php echo $dia; ?></p>
                  <?php foreach ($comidas_dia as $comida): ?>
                  <p class="text-[#49709c] text-sm font-normal leading-normal">
                    <?php echo $comida['comida']; ?>: <?php echo $comida['descripcion']; ?>
                  </p>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between">
                <p class="text-[#0d141c] text-base font-medium leading-normal">Progreso del Plan</p>
              </div>
              <div class="progress-bar">
                <?php 
                $dias_transcurridos = (strtotime(date('Y-m-d')) - strtotime($plan_nutricional['fecha_inicio'])) / (60 * 60 * 24);
                $dias_totales = (strtotime($plan_nutricional['fecha_fin']) - strtotime($plan_nutricional['fecha_inicio'])) / (60 * 60 * 24);
                $porcentaje = min(100, max(0, ($dias_transcurridos / $dias_totales) * 100));
                ?>
                <div class="progress-bar-fill" style="width: <?php echo $porcentaje; ?>%;"></div>
              </div>
              <p class="text-[#49709c] text-sm font-normal leading-normal">
                <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_inicio'])); ?> - 
                <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_fin'])); ?>
              </p>
            </div>
            <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Objetivos Nutricionales</h2>
            <div class="px-4">
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-2 checkbox-custom bg-transparent text-[#49709c] checked:bg-[#49709c] checked:border-[#49709c] focus:ring-0 focus:ring-offset-0 focus:border-[#49709c] focus:outline-none" />
                <p class="text-[#0d141c] text-base font-normal leading-normal">Mantener el objetivo de calorías diarias</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-2 checkbox-custom bg-transparent text-[#49709c] checked:bg-[#49709c] checked:border-[#49709c] focus:ring-0 focus:ring-offset-0 focus:border-[#49709c] focus:outline-none" />
                <p class="text-[#0d141c] text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_proteinas']); ?>g de proteínas diarias</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-2 checkbox-custom bg-transparent text-[#49709c] checked:bg-[#49709c] checked:border-[#49709c] focus:ring-0 focus:ring-offset-0 focus:border-[#49709c] focus:outline-none" />
                <p class="text-[#0d141c] text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_carbohidratos']); ?>g de carbohidratos diarios</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-2 checkbox-custom bg-transparent text-[#49709c] checked:bg-[#49709c] checked:border-[#49709c] focus:ring-0 focus:ring-offset-0 focus:border-[#49709c] focus:outline-none" />
                <p class="text-[#0d141c] text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_grasas']); ?>g de grasas diarias</p>
              </label>
            </div>
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

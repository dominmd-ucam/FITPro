<?php
require_once("controller/front_controller.php");

// Verificar si el usuario está logueado
if (!verificarSesionIniciada()) {
    header("Location: index.php?controlador=miembros&action=login");
    exit();
}

// Verificar si es administrador
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    header("Location: index.php");
    exit();
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
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
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

      /* Estilos para los bordes de la tabla */
      #membersTable tbody tr {
        border-bottom: 1px solid #e7edf4;
      }

      #membersTable tbody tr:last-child {
        border-bottom: none;
      }

      #membersTable tbody tr:hover {
        background-color: #f0f4f8;
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
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#49709c]">
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
                    <div class="text-[#0d141c]" data-icon="Users" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=miembros&action=home">Miembros</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="User" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=entrenadores&action=home">Entrenadores</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="UsersThree" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=clases&action=home">Clases</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="File" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=contactar&action=contacto">Incidencias</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Gear" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Zm88-29.84q.06-2.16,0-4.32l14.92-18.64a8,8,0,0,0,1.48-7.06,107.21,107.21,0,0,0-10.88-26.25,8,8,0,0,0-6-3.93l-23.72-2.64q-1.48-1.56-3-3L186,40.54a8,8,0,0,0-3.94-6,107.71,107.71,0,0,0-26.25-10.87,8,8,0,0,0-7.06,1.49L130.16,40Q128,40,125.84,40L107.2,25.11a8,8,0,0,0-7.06-1.48A107.6,107.6,0,0,0,73.89,34.51a8,8,0,0,0-3.93,6L67.32,64.27q-1.56,1.49-3,3L40.54,70a8,8,0,0,0-6,3.94,107.71,107.71,0,0,0-10.87,26.25,8,8,0,0,0,1.49,7.06L40,125.84Q40,128,40,130.16L25.11,148.8a8,8,0,0,0-1.48,7.06,107.21,107.21,0,0,0,10.88,26.25,8,8,0,0,0,6,3.93l23.72,2.64q1.49,1.56,3,3L70,215.46a8,8,0,0,0,3.94,6,107.71,107.71,0,0,0,26.25,10.87,8,8,0,0,0,7.06-1.49L125.84,216q2.16.06,4.32,0l18.64,14.92a8,8,0,0,0,7.06,1.48,107.21,107.21,0,0,0,26.25-10.88,8,8,0,0,0,3.93-6l2.64-23.72q1.56-1.48,3-3L215.46,186a8,8,0,0,0,6-3.94,107.71,107.71,0,0,0,10.87-26.25,8,8,0,0,0-1.49-7.06Zm-16.1-6.5a73.93,73.93,0,0,1,0,8.68,8,8,0,0,0,1.74,5.48l14.19,17.73a91.57,91.57,0,0,1-6.23,15L187,173.11a8,8,0,0,0-5.1,2.64,74.11,74.11,0,0,1-6.14,6.14,8,8,0,0,0-2.64,5.1l-2.51,22.58a91.32,91.32,0,0,1-15,6.23l-17.74-14.19a8,8,0,0,0-5-1.75h-.48a73.93,73.93,0,0,1-8.68,0,8,8,0,0,0-5.48,1.74L100.45,215.8a91.57,91.57,0,0,1-15-6.23L82.89,187a8,8,0,0,0-2.64-5.1,74.11,74.11,0,0,1-6.14-6.14,8,8,0,0,0-5.1-2.64L46.43,170.6a91.32,91.32,0,0,1-6.23-15l14.19-17.74a8,8,0,0,0,1.74-5.48,73.93,73.93,0,0,1,0-8.68,8,8,0,0,0-1.74-5.48L40.2,100.45a91.57,91.57,0,0,1,6.23-15L69,82.89a8,8,0,0,0,5.1-2.64,74.11,74.11,0,0,1,6.14-6.14A8,8,0,0,0,82.89,69L85.4,46.43a91.32,91.32,0,0,1,15-6.23l17.74,14.19a8,8,0,0,0,5.48,1.74,73.93,73.93,0,0,1,8.68,0,8,8,0,0,0,5.48-1.74L155.55,40.2a91.57,91.57,0,0,1,15,6.23L173.11,69a8,8,0,0,0,2.64,5.1,74.11,74.11,0,0,1,6.14,6.14,8,8,0,0,0,5.1,2.64l22.58,2.51a91.32,91.32,0,0,1,6.23,15l-14.19,17.74A8,8,0,0,0,199.87,123.66Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="#">Ajustes</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-[#0d141c]" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-[#0d141c] text-sm font-medium leading-normal" href="index.php?controlador=contactar&action=contacto">Ayuda &amp; feedback</a>
                  </div>
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
            <p class="text-[#0d141c] tracking-light text-[32px] font-bold leading-tight min-w-72">Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></p>
          </div>
          
          <div class="flex flex-wrap gap-3 p-4">
            <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#e7edf4] p-4">
              <p class="text-[#49709c] text-sm font-medium leading-normal">Miembros Totales</p>
              <p class="text-[#0d141c] text-[32px] font-bold leading-tight"><?php echo $totalMembers; ?></p>
            </div>
            <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#e7edf4] p-4">
              <p class="text-[#49709c] text-sm font-medium leading-normal">Miembros Activos</p>
              <p class="text-[#0d141c] text-[32px] font-bold leading-tight"><?php echo $activeMembers; ?></p>
            </div>
            <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#e7edf4] p-4">
              <p class="text-[#49709c] text-sm font-medium leading-normal">Miembros Inactivos</p>
              <p class="text-[#0d141c] text-[32px] font-bold leading-tight"><?php echo $inactiveMembers; ?></p>
            </div>
            <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#e7edf4] p-4">
              <p class="text-[#49709c] text-sm font-medium leading-normal">Total Ingresos (Mes)</p>
              <p class="text-[#0d141c] text-[32px] font-bold leading-tight">€<?php echo number_format($totalRevenue, 2); ?></p>
            </div>
          </div>
          
          <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Registros de Acceso</h2>
          
          <div class="px-4 py-3">
            <div class="flex flex-col overflow-hidden rounded-xl border border-[#49709c] bg-[#f8fafc]">
              <?php foreach ($lastAccessLogs as $log): ?>
              <div class="flex items-center gap-4 bg-[#f8fafc] px-4 min-h-[72px] py-2 justify-between border-b border-[#e7edf4] w-full">
                <div class="flex flex-col justify-center">
                  <p class="text-[#0d141c] text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($log['nombre']); ?></p>
                  <p class="text-[#49709c] text-sm font-normal leading-normal line-clamp-2">
                    <?php 
                    $fecha = new DateTime($log['fecha']);
                    echo $fecha->format('d/m/Y H:i') . ' - ' . 
                        ($log['codigo_qr']);
                    ?>
                  </p>
                </div>
                <div class="shrink-0">
                  <span class="flex min-w-[84px] max-w-[480px] items-center justify-center overflow-hidden rounded-xl h-8 px-4 <?php echo $log['tipo'] == 'entrada' ? 'bg-green-600' : 'bg-red-600'; ?> text-white text-sm font-medium leading-normal w-fit">
                    <?php echo $log['tipo'] == 'entrada' ? 'Entrada' : 'Salida'; ?>
                  </span>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <?php
          require_once("model/clases_model.php");
          $clasesModel = new ClasesModel();
          $clasesHoy = $clasesModel->get_clases_hoy();
          ?>

          <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Clases de Hoy</h2>
          
          <div class="px-4 py-3">
            <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4">
              <?php foreach ($clasesHoy as $clase): ?>
              <div class="flex flex-col gap-3 rounded-xl border border-[#49709c] bg-[#f8fafc] p-4">
                <div>
                  <p class="text-[#0d141c] text-lg font-bold leading-normal"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                  <p class="text-[#49709c] text-sm font-normal leading-normal">Instructor: <?php echo htmlspecialchars($clase['nombre_entrenador']); ?></p>
                  <p class="text-[#49709c] text-sm font-normal leading-normal">
                    <?php echo htmlspecialchars($clase['dia_semana']); ?> - 
                    <?php echo date('H:i', strtotime($clase['hora_inicio'])); ?> a 
                    <?php echo date('H:i', strtotime($clase['hora_fin'])); ?>
                  </p>
                </div>
                
                <?php if (!empty($clase['alumnos'])): ?>
                <div class="mt-2">
                  <p class="text-[#0d141c] text-sm font-medium leading-normal mb-2">Alumnos Inscritos:</p>
                  <div class="flex flex-col gap-2">
                    <?php foreach ($clase['alumnos'] as $alumno): ?>
                    <div class="flex items-center gap-2 bg-[#e7edf4] px-3 py-2 rounded-lg">
                      <p class="text-[#0d141c] text-sm font-normal leading-normal flex-1"><?php echo htmlspecialchars($alumno); ?></p>
                      <form action="index.php?controlador=clases&action=eliminarAlumno" method="POST" class="ml-auto" onsubmit="return confirmarEliminacion(event)">
                        <input type="hidden" name="clase_id" value="<?php echo $clase['id']; ?>">
                        <input type="hidden" name="alumno_nombre" value="<?php echo htmlspecialchars($alumno); ?>">
                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM80,104a8,8,0,0,1,16,0v64a8,8,0,0,1-16,0Zm80,0a8,8,0,0,1,16,0v64a8,8,0,0,1-16,0Z"></path>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <?php else: ?>
                <div class="mt-2">
                  <p class="text-[#49709c] text-sm font-normal leading-normal">No hay alumnos inscritos</p>
                </div>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <h2 class="text-[#0d141c] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Ingresos esperados</h2>
          <div class="flex flex-wrap gap-4 px-4 py-3">
            <div class="flex min-w-72 flex-1 flex-col gap-2">
              <p class="text-[#0d141c] text-base font-medium leading-normal">3.000€</p>
              <div class="flex overflow-hidden rounded-xl border border-[#49709c] bg-[#f8fafc] p-4">
                <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
                  <svg width="100%" height="148" viewBox="-3 0 478 150" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                    <path
                      d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H326.769H0V109Z"
                      fill="url(#paint0_linear_1131_5935)"
                    ></path>
                    <path
                      d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                      stroke="#49709c"
                      stroke-width="3"
                      stroke-linecap="round"
                    ></path>
                    <defs>
                      <linearGradient id="paint0_linear_1131_5935" x1="236" y1="1" x2="236" y2="149" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#e7edf4"></stop>
                        <stop offset="1" stop-color="#e7edf4" stop-opacity="0"></stop>
                      </linearGradient>
                    </defs>
                  </svg>
                  <div class="flex justify-around">
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Jan</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Feb</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Mar</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Apr</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">May</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Jun</p>
                    <p class="text-[#49709c] text-[13px] font-bold leading-normal tracking-[0.015em]">Jul</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

      function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target;
        
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Esta acción no se puede deshacer",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#0c77f2',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
        
        return false;
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

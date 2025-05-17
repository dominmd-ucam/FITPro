<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <title>Dashboard Usuario</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#111418] dark group/design-root overflow-x-hidden" style='font-family: Lexend, "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <div class="gap-1 px-6 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-80 fixed left-6 top-5 bottom-5">
            <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#111418] p-4">
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#293038]">
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
                    <div class="text-white" data-icon="User" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=perfil&action=ver">Mi Perfil</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Clock" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h40A8,8,0,0,1,176,128Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=horario&action=ver">Horario</a>
                  </div>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"
                        ></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="#">Ayuda</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Question" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8" />
                        <path d="M7 12h10M7 12l4-4M7 12l4 4" />
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=miembros&action=desconectar">Cerrar Sesión</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="layout-content-container flex flex-col max-w-[1100px] flex-1 ml-[320px]">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?></p>
            </div>
            <div class="flex flex-wrap gap-3 p-4">
              <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#111922] p-4">
                <p class="text-[#93adc8] text-sm font-medium leading-normal">Clases Asignadas</p>
                <p class="text-white text-[32px] font-bold leading-tight"><?php echo $clasesAsignadas; ?></p>
              </div>
              <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#111922] p-4">
                <p class="text-[#93adc8] text-sm font-medium leading-normal">Próxima Clase</p>
                <p class="text-white text-[32px] font-bold leading-tight"><?php echo $proximaClase; ?></p>
              </div>
              <div class="flex min-w-[200px] flex-1 flex-col gap-1 rounded-xl bg-[#111922] p-4">
                <p class="text-[#93adc8] text-sm font-medium leading-normal">Estado de Membresía</p>
                <p class="text-white text-[32px] font-bold leading-tight"><?php echo $estadoMembresia; ?></p>
              </div>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Mis Últimos Accesos</h2>
            <?php foreach ($ultimosAccesos as $acceso): ?>
            <div class="flex items-center gap-4 bg-[#111418] px-4 min-h-[72px] py-2 justify-between">
              <div class="flex flex-col justify-center">
                <p class="text-white text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($acceso['nombre']); ?></p>
                <p class="text-[#9daab8] text-sm font-normal leading-normal line-clamp-2">
                    <?php 
                    $fecha = new DateTime($acceso['fecha']);
                    echo $fecha->format('d/m/Y H:i') . ' - ' . 
                         ($acceso['codigo_qr']);
                    ?>
                </p>
              </div>
              <div class="shrink-0">
                <span class="flex min-w-[84px] max-w-[480px] items-center justify-center overflow-hidden rounded-xl h-8 px-4 <?php echo $acceso['tipo'] == 'entrada' ? 'bg-green-600' : 'bg-red-600'; ?> text-white text-sm font-medium leading-normal w-fit">
                  <?php echo $acceso['tipo'] == 'entrada' ? 'Entrada' : 'Salida'; ?>
                </span>
              </div>
            </div>
            <?php endforeach; ?>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Próximas Clases</h2>
            <div class="flex flex-wrap gap-4 px-4 py-6">
              <?php foreach ($proximasClases as $clase): ?>
              <div class="flex min-w-[300px] flex-1 flex-col gap-2 rounded-xl bg-[#111922] p-4">
                <p class="text-white text-base font-medium leading-normal"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                <p class="text-[#9daab8] text-sm font-normal leading-normal">
                  <?php echo htmlspecialchars($clase['fecha']); ?>
                </p>
                <p class="text-[#9daab8] text-sm font-normal leading-normal">
                  Entrenador: <?php echo htmlspecialchars($clase['entrenador']); ?>
                </p>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html> 
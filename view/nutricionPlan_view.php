<?php
// Verificar si hay un plan nutricional
if (!isset($plan_nutricional) || empty($plan_nutricional)) {
    echo '<div class="text-center p-8">
            <h2 class="text-white text-2xl font-bold mb-4">No tienes un plan nutricional activo</h2>
            <p class="text-[#9daab8] mb-4">Contacta con un entrenador para obtener un plan personalizado</p>
            <button class="bg-[#1568c1] text-white px-6 py-2 rounded-xl">Contactar Entrenador</button>
          </div>';
    exit;
}
?>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <title>Plan Nutricional - GymTrack</title>
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
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="House" data-size="24px" data-weight="fill">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=home&action=home">Dashboard</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2">
                    <div class="text-white" data-icon="Calendar" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM48,48H72v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                      </svg>
                    </div>
                    <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=classShedule&action=home">Mis Clases</a>
                  </div>
                  <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#293038]">
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
                  <div class="flex items-center gap-3 px-3 py-2">
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
              <div class="flex min-w-72 flex-col gap-3">
                <p class="text-white tracking-light text-[32px] font-bold leading-tight">Tu plan nutricional</p>
                <p class="text-[#9daab8] text-sm font-normal leading-normal">Inicio: <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_inicio'])); ?></p>
              </div>
            </div>
            <div class="flex flex-wrap gap-4 p-4">
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Calorías</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_calorias']); ?></p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Proteínas</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_proteinas']); ?>g</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Carbohidratos</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_carbohidratos']); ?>g</p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#3c4753]">
                <p class="text-white text-base font-medium leading-normal">Grasas</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo round($info_nutricional['total_grasas']); ?>g</p>
              </div>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Plan Semanal</h2>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <?php
              $dias_semana = [
                'Lunes' => 'https://travelingua.es/wp-content/uploads/2023/11/comida-tipica-canada.jpg',
                'Martes' => 'https://sophiederam.com/wp-content/uploads/2022/05/alimentos-saudaveis-para-o-almoco.png',
                'Miércoles' => 'https://cdn.businessinsider.es/sites/navi.axelspringer.es/public/media/image/2023/04/plato-harvard-3006638.jpg?tf=3840x',
                'Jueves' => 'https://xurrosymas.mx/wp-content/uploads/2024/08/comida-saludable-1024x675.jpg',
                'Viernes' => 'https://www.clarin.com/2024/08/18/GwjPHUqMQ_2000x1500__1.jpg',
                'Sábado' => 'https://media-cdn.tripadvisor.com/media/photo-s/1a/44/72/cf/aprende-a-cocinar-comida.jpg',
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
                  <p class="text-white text-base font-medium leading-normal"><?php echo $dia; ?></p>
                  <?php foreach ($comidas_dia as $comida): ?>
                  <p class="text-[#9daab8] text-sm font-normal leading-normal">
                    <?php echo $comida['comida']; ?>: <?php echo $comida['descripcion']; ?>
                  </p>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between">
                <p class="text-white text-base font-medium leading-normal">Progreso del Plan</p>
              </div>
              <div class="rounded bg-[#3c4753]">
                <?php 
                $dias_transcurridos = (strtotime(date('Y-m-d')) - strtotime($plan_nutricional['fecha_inicio'])) / (60 * 60 * 24);
                $dias_totales = (strtotime($plan_nutricional['fecha_fin']) - strtotime($plan_nutricional['fecha_inicio'])) / (60 * 60 * 24);
                $porcentaje = min(100, max(0, ($dias_transcurridos / $dias_totales) * 100));
                ?>
                <div class="h-2 rounded bg-white" style="width: <?php echo $porcentaje; ?>%;"></div>
              </div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">
                <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_inicio'])); ?> - 
                <?php echo date('d/m/Y', strtotime($plan_nutricional['fecha_fin'])); ?>
              </p>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Objetivos Nutricionales</h2>
            <div class="px-4">
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-[#3c4753] border-2 bg-transparent text-[#1568c1] checked:bg-[#1568c1] checked:border-[#1568c1] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#3c4753] focus:outline-none" />
                <p class="text-white text-base font-normal leading-normal">Mantener el objetivo de calorías diarias</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-[#3c4753] border-2 bg-transparent text-[#1568c1] checked:bg-[#1568c1] checked:border-[#1568c1] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#3c4753] focus:outline-none" />
                <p class="text-white text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_proteinas']); ?>g de proteínas diarias</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-[#3c4753] border-2 bg-transparent text-[#1568c1] checked:bg-[#1568c1] checked:border-[#1568c1] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#3c4753] focus:outline-none" />
                <p class="text-white text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_carbohidratos']); ?>g de carbohidratos diarios</p>
              </label>
              <label class="flex gap-x-3 py-3 flex-row">
                <input type="checkbox" class="h-5 w-5 rounded border-[#3c4753] border-2 bg-transparent text-[#1568c1] checked:bg-[#1568c1] checked:border-[#1568c1] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#3c4753] focus:outline-none" />
                <p class="text-white text-base font-normal leading-normal">Consumir <?php echo round($info_nutricional['total_grasas']); ?>g de grasas diarias</p>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

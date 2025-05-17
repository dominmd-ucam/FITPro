<!DOCTYPE html>
<html>

<head>
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
  <link
    rel="stylesheet"
    as="style"
    onload="this.rel='stylesheet'"
    href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900" />

  <title>Class Schedule</title>
  <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  
  <!-- FullCalendar CSS -->
  <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/main.min.css' rel='stylesheet' />
  <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/main.min.css' rel='stylesheet' />
  <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.10/main.min.css' rel='stylesheet' />
  
  <!-- FullCalendar JS -->
  <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/main.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/main.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.10/main.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/main.min.js'></script>

  <style>
    /* Estilos para el calendario */
    .fc {
      background-color: #111922;
      color: white;
      height: 600px;
    }

    .fc .fc-toolbar {
      background-color: #111922;
      padding: 1rem;
    }

    .fc .fc-toolbar-title {
      color: white;
      font-size: 1.5rem;
    }

    .fc .fc-button {
      background-color: #1568c1;
      border-color: #1568c1;
    }

    .fc .fc-button:hover {
      background-color: #1d7ce1;
      border-color: #1d7ce1;
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active {
      background-color: #1d7ce1;
      border-color: #1d7ce1;
    }

    .fc .fc-col-header-cell {
      background-color: #1c2a38;
      color: white;
    }

    .fc .fc-daygrid-day {
      background-color: #111922;
    }

    .fc .fc-daygrid-day-number {
      color: white;
    }

    .fc .fc-timegrid-slot {
      background-color: #111922;
      color: white;
    }

    .fc .fc-timegrid-slot-label {
      color: #93adc8;
    }

    .fc .fc-event {
      background-color: #1568c1;
      border-color: #1568c1;
    }

    .fc .fc-event:hover {
      background-color: #1d7ce1;
      border-color: #1d7ce1;
    }

    .fc .fc-event-title {
      color: white;
    }

    .fc .fc-event-time {
      color: white;
    }

    .fc .fc-day-today {
      background-color: #1c2a38 !important;
    }

    .fc .fc-daygrid-day.fc-day-today {
      background-color: #1c2a38 !important;
    }

    .fc .fc-timegrid-now-indicator-line {
      border-color: #1568c1;
    }

    .fc .fc-timegrid-now-indicator-arrow {
      border-color: #1568c1;
    }

    .calendar {
      background-color: #111922;
      border-radius: 0.75rem;
      padding: 1rem;
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
      background-color: #1c2a38;
      border-radius: 0.5rem;
      padding: 0.5rem;
      min-height: 100px;
      color: white;
    }
    
    .calendar-day-header {
      text-align: center;
      font-weight: bold;
      color: #93adc8;
      padding: 0.5rem;
    }
    
    .calendar-event {
      background-color: #1568c1;
      border-radius: 0.25rem;
      padding: 0.25rem;
      margin: 0.25rem 0;
      font-size: 0.875rem;
      color: white;
    }
    
    .calendar-today {
      background-color: #1d7ce1;
    }
    
    .calendar-nav-button {
      background-color: #1568c1;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      cursor: pointer;
    }
    
    .calendar-nav-button:hover {
      background-color: #1d7ce1;
    }
  </style>
</head>

<body>
  <div class="relative flex size-full min-h-screen flex-col bg-[#111418] dark group/design-root overflow-x-hidden" style='font-family: Lexend, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
      <div class="gap-1 px-6 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col w-80 fixed left-6 top-5 bottom-5">
          <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#111418] p-4">
            <div class="flex flex-col gap-4">
              <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 px-3 py-2 ">
                  <div class="text-white" data-icon="House" data-size="24px" data-weight="fill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"></path>
                    </svg>
                  </div>
                  <a class="text-white text-sm font-medium leading-normal" href="index.php?controlador=home&action=home">Dashboard</a>
                </div>
                <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#293038]">
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
                      <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
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
                      <path d="M140,180a12,12,0,1,1-12-12A12,12,0,0,1,140,180ZM128,72c-22.06,0-40,16.15-40,36v4a8,8,0,0,0,16,0v-4c0-11,10.77-20,24-20s24,9,24,20-10.77,20-24,20a8,8,0,0,0-8,8v8a8,8,0,0,0,16,0v-.72c18.24-3.35,32-17.9,32-35.28C168,88.15,150.06,72,128,72Zm104,56A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path>
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
          <div class="px-40 flex flex-1 justify-center py-5">
            <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
              <div class="flex flex-wrap justify-between gap-3 p-4">
                <p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Class Schedule</p>
              </div>

              <!-- Calendario -->
              <div class="bg-[#111922] p-6 rounded-xl mx-4 mb-4">
                <div class="max-w-7xl mx-auto">
                  <!-- Cabecera del Calendario -->
                  <div class="flex items-center justify-between mb-4">
                    <button onclick="previousMonth()" class="p-2 text-white hover:bg-[#1c2a38] rounded-lg transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                      </svg>
                    </button>
                    <h2 id="currentMonth" class="text-xl font-semibold text-white"></h2>
                    <button onclick="nextMonth()" class="p-2 text-white hover:bg-[#1c2a38] rounded-lg transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                      </svg>
                    </button>
                  </div>

                  <!-- Días de la semana -->
                  <div class="grid grid-cols-7 gap-1 mb-2">
                    <div class="text-center text-[#93adc8] font-medium">Lun</div>
                    <div class="text-center text-[#93adc8] font-medium">Mar</div>
                    <div class="text-center text-[#93adc8] font-medium">Mié</div>
                    <div class="text-center text-[#93adc8] font-medium">Jue</div>
                    <div class="text-center text-[#93adc8] font-medium">Vie</div>
                    <div class="text-center text-[#93adc8] font-medium">Sáb</div>
                    <div class="text-center text-[#93adc8] font-medium">Dom</div>
                  </div>

                  <!-- Grid del Calendario -->
                  <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                    <!-- Los días se generarán dinámicamente aquí -->
                  </div>
                </div>
              </div>

              <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Today</h3>
              <div class="flex flex-col gap-2 px-4 rounded-xl bg-[#111922] p-4">
                <?php if (empty($clases_hoy)): ?>
                  <p class="text-white text-center py-4">No tienes clases programadas para hoy</p>
                <?php else: ?>
                  <?php foreach ($clases_hoy as $clase): ?>
                    <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                      <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                        style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                      <div class="flex flex-col justify-center">
                        <p class="text-white text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                        <p class="text-[#93adc8] text-sm font-normal leading-normal line-clamp-2">
                          <?php 
                            $hora_inicio = date('g:i A', strtotime($clase['hora_inicio']));
                            $hora_fin = date('g:i A', strtotime($clase['hora_fin']));
                            echo htmlspecialchars($clase['dia_semana'] . ', ' . $hora_inicio . ' - ' . $hora_fin);
                          ?>
                        </p>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Upcoming</h3>
              <div class="flex flex-col gap-2 px-4 rounded-xl bg-[#111922] p-4">
                <?php if (empty($proximas_clases)): ?>
                  <p class="text-white text-center py-4">No tienes próximas clases programadas</p>
                <?php else: ?>
                  <?php foreach ($proximas_clases as $clase): ?>
                    <div class="flex items-center gap-4 min-h-[72px] py-2 rounded-xl">
                      <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-14"
                        style='background-image: url("https://cdn.usegalileo.ai/sdxl10/780c93d5-68e9-46a9-8978-e20d6d49192a.png");'></div>
                      <div class="flex flex-col justify-center">
                        <p class="text-white text-base font-medium leading-normal line-clamp-1"><?php echo htmlspecialchars($clase['nombre']); ?></p>
                        <p class="text-[#93adc8] text-sm font-normal leading-normal line-clamp-2">
                          <?php 
                            $hora_inicio = date('g:i A', strtotime($clase['hora_inicio']));
                            $hora_fin = date('g:i A', strtotime($clase['hora_fin']));
                            echo htmlspecialchars($clase['dia_semana'] . ', ' . $hora_inicio . ' - ' . $hora_fin);
                          ?>
                        </p>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    let currentDate = new Date();
    const eventos = [
      <?php 
      $todos_eventos = array_merge($clases_hoy, $proximas_clases);
      foreach ($todos_eventos as $clase) {
        $dias = [
          'Lunes' => 1, 'Martes' => 2, 'Miércoles' => 3, 
          'Jueves' => 4, 'Viernes' => 5, 'Sábado' => 6, 'Domingo' => 7
        ];
        $dia_numero = $dias[$clase['dia_semana']];
        
        $fecha_actual = new DateTime();
        $dias_para_sumar = ($dia_numero - $fecha_actual->format('N') + 7) % 7;
        $fecha_actual->modify("+$dias_para_sumar days");
        
        $fecha = $fecha_actual->format('Y-m-d');
        $hora_inicio = date('H:i', strtotime($clase['hora_inicio']));
        $hora_fin = date('H:i', strtotime($clase['hora_fin']));
        
        echo "{
          title: '" . addslashes($clase['nombre']) . "',
          date: '" . $fecha . "',
          start: '" . $hora_inicio . "',
          end: '" . $hora_fin . "',
          description: '" . addslashes($clase['descripcion']) . "',
          entrenador: '" . addslashes($clase['nombre_entrenador']) . "'
        },";
      }
      ?>
    ];

    function renderCalendar() {
      const year = currentDate.getFullYear();
      const month = currentDate.getMonth();
      
      // Actualizar título del mes
      const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                         "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;
      
      // Obtener primer y último día del mes
      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);
      
      // Calcular día de la semana del primer día (0 = Domingo, 1 = Lunes, etc.)
      let firstDayOfWeek = firstDay.getDay();
      // Ajustar para que la semana empiece en lunes
      firstDayOfWeek = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1;
      
      let calendarHTML = '';
      
      // Añadir días vacíos al principio
      for (let i = 0; i < firstDayOfWeek; i++) {
        calendarHTML += `
          <div class="aspect-square p-2 bg-[#1c2a38] rounded-lg opacity-50"></div>
        `;
      }
      
      // Añadir días del mes
      for (let day = 1; day <= lastDay.getDate(); day++) {
        const date = new Date(year, month, day);
        const dateString = date.toISOString().split('T')[0];
        const isToday = date.toDateString() === new Date().toDateString();
        
        // Filtrar eventos para este día
        const dayEvents = eventos.filter(event => event.date === dateString);
        
        let eventsHTML = '';
        dayEvents.forEach(event => {
          eventsHTML += `
            <div class="text-xs p-1 mb-1 bg-[#1568c1] text-white rounded truncate cursor-pointer hover:bg-[#1d7ce1] transition-colors"
                 title="${event.title} - ${event.start} a ${event.end}">
              ${event.title}
            </div>
          `;
        });
        
        calendarHTML += `
          <div class="aspect-square p-2 ${isToday ? 'bg-[#1d7ce1]' : 'bg-[#1c2a38]'} rounded-lg relative group">
            <div class="text-right text-white mb-1">${day}</div>
            <div class="flex flex-col gap-1">
              ${dayEvents.slice(0, 3).map(event => `
                <div class="text-xs p-1 bg-[#1568c1] text-white rounded truncate cursor-pointer hover:bg-[#1d7ce1] transition-colors"
                     title="${event.title} - ${event.start} a ${event.end}">
                  ${event.title}
                </div>
              `).join('')}
            </div>
            ${dayEvents.length > 3 ? `
              <div class="absolute bottom-1 right-1 text-xs text-[#93adc8]">
                +${dayEvents.length - 3} más
              </div>
            ` : ''}
          </div>
        `;
      }
      
      document.getElementById('calendarGrid').innerHTML = calendarHTML;
    }

    function previousMonth() {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar();
    }

    function nextMonth() {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar();
    }

    // Inicializar el calendario
    document.addEventListener('DOMContentLoaded', renderCalendar);
  </script>
</body>

</html>
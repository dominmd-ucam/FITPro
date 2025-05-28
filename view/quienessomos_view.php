<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Quiénes somos - FitPro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php require_once("view/menu.php"); ?>

<body class="bg-[#F8FAFC] text-white font-sans leading-relaxed">

  <!-- Hero -->
  <section class="relative h-[350px] md:h-[420px] flex items-center justify-center bg-cover bg-center" style="background-image: url('assets/imagenes/personas-que-trabajan-en-el-interior-junto-con-pesas.jpg');">
    <div class="absolute inset-0 bg-opacity-60"></div>
    <div class="relative z-10 text-center text-white px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4 fade-in">Quiénes somos</h1>
      <p class="text-lg max-w-2xl mx-auto fade-in">Un equipo comprometido con tu salud y bienestar. Tecnología, personas y movimiento al servicio de tu transformación.</p>
    </div>
  </section>

  <main class="max-w-6xl mx-auto px-4 py-16">

    <!-- Historia -->
    <section class="mb-20 fade-in">
      <h2 class="text-2xl font-semibold mb-4">Nuestra historia</h2>
      <p class="mb-4">
        FitPro nació en 2025 con una misión clara: democratizar el acceso al fitness de calidad. Empezamos en Murcia con un pequeño grupo de entrenadores comprometidos y hoy somos una comunidad de más de 15.000 miembros que apuestan por la salud inteligente.
      </p>
      <p>
        Nuestro enfoque une cuerpo, mente y entorno. Combinamos tecnología, atención personalizada e innovación constante para ofrecer programas integrales adaptados a cada persona.
      </p>
    </section>

    <!-- Valores -->
    <section class="mb-20 fade-in">
      <h2 class="text-2xl font-semibold mb-6">Nuestros valores</h2>
      <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <div class="mb-4 text-[#0C77F2] text-4xl"><i class="bi bi-people-fill"></i></div>
          <h3 class="text-lg font-semibold mb-2 text-[#0C77F2]">Cercanía real</h3>
          <p class="text-black">Estamos contigo, te escuchamos y adaptamos cada paso a tu realidad personal.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <div class="mb-4 text-[#0C77F2] text-4xl"><i class="bi bi-cpu-fill"></i></div>
          <h3 class="text-lg font-semibold mb-2 text-[#0C77F2]">Innovación con propósito</h3>
          <p class="text-black">Usamos tecnología y datos para ayudarte a avanzar de forma segura y eficaz.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <div class="mb-4 text-[#0C77F2] text-4xl"><i class="bi bi-heart-pulse-fill"></i></div>
          <h3 class="text-lg font-semibold mb-2 text-[#0C77F2]">Bienestar sostenible</h3>
          <p class="text-black">Sabemos que no se trata de hacerlo todo en un día, sino de mantenerlo cada día.</p>
        </div>
      </div>
    </section>

    <!-- Equipo -->
    <section class="mb-20 fade-in">
      <div class="bg-gradient-to-r from-[#0C77F2]/10 to-transparent rounded-xl overflow-hidden shadow-md">
        <img src="assets/imagenes/peso-saludable-cuidado-masculino-atletico.jpg" alt="Equipo FitPro" class="w-full h-80 object-cover rounded-xl">
      </div>
      <h2 class="text-2xl font-semibold mb-2 mt-8 text-center">Nuestro equipo</h2>
      <p class="text-center max-w-3xl mx-auto">
        Contamos con profesionales apasionados: entrenadores certificados, nutricionistas, psicólogos deportivos, fisioterapeutas y desarrolladores que entienden que cuidar de las personas también es innovar por ellas.
      </p>
    </section>

    <!-- CTA -->
    <section class="text-center mt-24 fade-in">
      <h2 class="text-3xl font-bold mb-4">¿Quieres unirte a FitPro?</h2>
      <p class="mb-6 max-w-xl mx-auto">Forma parte de un movimiento que apuesta por la salud desde lo humano y lo digital. Tu mejor versión comienza hoy.</p>
      <a href="index.php?controlador=miembros&action=registro" class="bg-[#0C77F2] text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 transition">Empieza ahora</a>
    </section>

  </main>

</body>
</html>

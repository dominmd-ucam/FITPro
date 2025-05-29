<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Preguntas Frecuentes - FitPro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php require_once("view/menu.php"); ?>

<body class="bg-[#F8FAFC] text-black font-sans leading-relaxed">

  <!-- Hero con imagen de fondo -->
  <section class="relative h-[350px] md:h-[420px] flex items-center justify-center bg-cover bg-center" style="background-image: url('assets/imagenes/levantarBarra.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-10"></div> <!-- puedes quitar esta capa si no quieres oscurecer -->
    <div class="relative z-10 text-center text-white px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Preguntas Frecuentes</h1>
      <p class="text-lg max-w-2xl mx-auto">Aquí encontrarás respuestas a las dudas más comunes sobre entrenamiento, nutrición y bienestar. ¡Explora y aprende!</p>
    </div>
  </section>

  <!-- Preguntas frecuentes -->
  <main class="max-w-4xl mx-auto px-4 py-16">
    <div class="space-y-6">

      <!-- Pregunta 1 -->
      <div class="bg-white rounded-lg shadow p-6">
        <button onclick="toggleAnswer('q1')" class="w-full text-left text-lg font-semibold text-[#0C77F2] flex justify-between items-center">
          ¿Cuántos días a la semana debo entrenar?
          <span class="transition-transform duration-300" id="icon-q1">▼</span>
        </button>
        <div id="q1" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out text-black">
          <p class="mt-2">Lo ideal es entrenar entre 3 y 5 veces por semana, combinando fuerza, cardio y movilidad. Lo más importante es la constancia.</p>
        </div>
      </div>

      <!-- Pregunta 2 -->
      <div class="bg-white rounded-lg shadow p-6">
        <button onclick="toggleAnswer('q2')" class="w-full text-left text-lg font-semibold text-[#0C77F2] flex justify-between items-center">
          ¿Qué debo comer antes y después de entrenar?
          <span class="transition-transform duration-300" id="icon-q2">▼</span>
        </button>
        <div id="q2" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out text-black">
          <p class="mt-2">Antes de entrenar es ideal una comida ligera con carbohidratos complejos. Después del ejercicio se recomienda proteína y algo de carbohidratos para recuperar energía.</p>
        </div>
      </div>

      <!-- Pregunta 3 -->
      <div class="bg-white rounded-lg shadow p-6">
        <button onclick="toggleAnswer('q3')" class="w-full text-left text-lg font-semibold text-[#0C77F2] flex justify-between items-center">
          ¿Necesito suplementos para ver resultados?
          <span class="transition-transform duration-300" id="icon-q3">▼</span>
        </button>
        <div id="q3" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out text-black">
          <p class="mt-2">No son imprescindibles. Una buena alimentación y descanso son suficientes para la mayoría. Los suplementos pueden ayudar si hay carencias específicas.</p>
        </div>
      </div>

      <!-- Pregunta 4 -->
      <div class="bg-white rounded-lg shadow p-6">
        <button onclick="toggleAnswer('q4')" class="w-full text-left text-lg font-semibold text-[#0C77F2] flex justify-between items-center">
          ¿Cuánto tiempo tardaré en notar resultados?
          <span class="transition-transform duration-300" id="icon-q4">▼</span>
        </button>
        <div id="q4" class="max-h-0 overflow-hidden opacity-0 transition-all duration-500 ease-in-out text-black">
          <p class="mt-2">Depende de tu punto de partida, pero en general entre 4 y 8 semanas puedes comenzar a notar mejoras físicas y de energía si eres constante.</p>
        </div>
      </div>

    </div>
  </main>

  <!-- Sección tipo blog -->
  <section class="py-16">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10">
      <div>
        <img src="assets/imagenes/blog-entrenamiento-fitpro.jpg" alt="Artículo de blog" class="rounded-xl shadow-md mb-4">
        <h2 class="text-2xl font-bold mb-2">¿Cardio o pesas primero?</h2>
        <p class="mb-4 text-black">Descubre cuál es el orden más efectivo según tus objetivos: perder grasa, ganar músculo o mejorar tu resistencia.</p>
        <a href="#" class="text-[#0C77F2] font-semibold hover:underline">Leer más →</a>
      </div>
      <div>
        <img src="assets/imagenes/blog-comida-saludable.jpg" alt="Nutrición deportiva" class="rounded-xl shadow-md mb-4">
        <h2 class="text-2xl font-bold mb-2">Ideas de snacks post-entreno</h2>
        <p class="mb-4 text-black">Te damos opciones rápidas y saludables para recuperar energía después del ejercicio sin perder tiempo en la cocina.</p>
        <a href="#" class="text-[#0C77F2] font-semibold hover:underline">Leer más →</a>
      </div>
    </div>
  </section>

  <!-- Script para animar preguntas -->
  <script>
    function toggleAnswer(id) {
      const answer = document.getElementById(id);
      const icon = document.getElementById('icon-' + id);
      answer.classList.toggle('max-h-0');
      answer.classList.toggle('max-h-96');
      answer.classList.toggle('opacity-0');
      answer.classList.toggle('opacity-100');
      answer.classList.toggle('mt-2');
      icon.classList.toggle('rotate-180');
    }
  </script>

</body>
</html>

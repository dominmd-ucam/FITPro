<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Todo sobre entrenamiento físico</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php require_once("view/menu.php"); ?>

<body class="bg-[#F8FAFC] text-black font-sans leading-relaxed">

  <main class="max-w-5xl mx-auto px-4 py-12 text-[#FFFFFF]">

    <!-- Imagen de portada -->
    <div class="w-full mb-10 rounded-xl overflow-hidden shadow-md">
      <img src="assets/imagenes/levantarBarra.jpg" alt="Entrenamiento físico" class="w-full h-72 object-cover">
    </div>

    <!-- Título principal -->
    <h1 class="text-4xl font-bold text-center mb-6">Todo sobre entrenamiento físico</h1>

    <!-- Intro -->
    <p class="text-lg mb-8 text-center max-w-3xl mx-auto">
      El entrenamiento físico no es solo una cuestión estética. Es una práctica integral que mejora el bienestar general, previene enfermedades y fortalece tanto el cuerpo como la mente. Este artículo detalla los tipos de entrenamiento, sus beneficios y consejos para aplicarlos en tu rutina.
    </p>

    <!-- Tipos de entrenamiento -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4">Tipos de entrenamiento</h2>
      <p class="mb-4">Los entrenamientos pueden clasificarse en función de los objetivos y capacidades individuales. Aquí se destacan algunos enfoques comunes:</p>
      <ul class="list-disc list-inside space-y-2">
        <li><strong>Entrenamiento de fuerza:</strong> se centra en el crecimiento muscular mediante cargas progresivas.</li>
        <li><strong>Cardiovascular:</strong> mejora la resistencia y el rendimiento del sistema cardiovascular.</li>
        <li><strong>Funcional:</strong> trabaja patrones de movimiento que imitan acciones cotidianas.</li>
        <li><strong>Movilidad y flexibilidad:</strong> promueve la prevención de lesiones y una mejor calidad de movimiento.</li>
      </ul>
    </section>

    <!-- Imagen entre secciones -->
    <div class="mb-12 rounded-xl overflow-hidden">
      <img src="assets/imagenes/personasPesas.jpg" alt="Personas entrenando" class="w-full h-64 object-cover">
    </div>

    <!-- Beneficios + tarjeta -->
    <section class="mb-12 grid md:grid-cols-3 gap-8">
      <div class="md:col-span-2">
        <h2 class="text-2xl font-semibold mb-4">Beneficios del entrenamiento regular</h2>
        <p class="mb-4">
          La constancia en la actividad física ofrece ventajas físicas, mentales y emocionales. Mejora la postura, el equilibrio hormonal y la composición corporal. Aumenta la energía, la capacidad pulmonar y la densidad ósea. Además, reduce el estrés, mejora la concentración y ayuda a combatir trastornos como la ansiedad o el insomnio.
        </p>
        <p>
          Entrenar también fortalece la disciplina personal. El compromiso con una rutina genera un impacto positivo en otros aspectos de la vida cotidiana, como la alimentación, el descanso y la gestión del tiempo.
        </p>
      </div>
      <aside class="bg-white border-l-4 border-[#0C77F2] p-5 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold mb-2 text-[#0C77F2]">Dato interesante</h3>
        <p class="text-sm text-black">
          Un estudio de Harvard demostró que realizar al menos 150 minutos de actividad moderada semanal reduce significativamente el riesgo de enfermedades crónicas y mejora la longevidad.
        </p>
      </aside>
    </section>

    <!-- Progresión -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4">Frecuencia, progresión y recuperación</h2>
      <p class="mb-4">
        Un plan de entrenamiento efectivo debe ajustarse gradualmente a las capacidades y evolución del individuo. La frecuencia ideal mínima es de tres veces por semana, combinando sesiones de fuerza, resistencia y movilidad. La progresión debe ser constante, pero no agresiva: subir cargas, aumentar repeticiones o modificar ejercicios debe hacerse con conciencia.
      </p>
      <p>
        La recuperación es tan importante como el esfuerzo. Dormir bien, estirar y llevar una alimentación adecuada acelera la regeneración muscular y previene lesiones. Un cuerpo descansado entrena mejor.
      </p>
    </section>

    <!-- Consejos -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4">Consejos prácticos para empezar (o mejorar)</h2>
      <ul class="list-disc list-inside space-y-2 mb-6">
        <li>Comienza con ejercicios básicos: dominar la técnica evita frustraciones y lesiones.</li>
        <li>Hazlo divertido: busca actividades que disfrutes y no se sientan como una obligación.</li>
        <li>Registra tus progresos: usar una app o una libreta ayuda a mantener la motivación.</li>
        <li>Evita compararte: cada cuerpo responde de manera diferente.</li>
        <li>No temas pedir ayuda: un entrenador puede acelerar y optimizar tus resultados.</li>
      </ul>
      <p>
        Lo más importante es la constancia. Un entrenamiento imperfecto pero constante es mucho mejor que uno perfecto e inconstante.
      </p>
    </section>

    <!-- Cierre -->
    <section class="text-center mt-20">
      <h2 class="text-xl font-semibold mb-2">Conclusión</h2>
      <p class="max-w-2xl mx-auto">
        El entrenamiento físico es una herramienta poderosa para transformar tu salud, tu cuerpo y tu mente. No se trata de competir, sino de construir una relación positiva con el movimiento. Empieza hoy. No necesitas ser perfecto, solo constante.
      </p>
    </section>

  </main>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Todo sobre nutrición saludable</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php require_once("view/menu.php"); ?>

<body class="font-sans leading-relaxed bg-[#F8FAFC] text-white">

  <main class="max-w-5xl mx-auto px-4 py-12">

    <!-- Imagen de portada -->
    <div class="w-full mb-10 rounded-xl overflow-hidden shadow-md">
      <img src="assets/imagenes/platoTazonVerduras.jpg" alt="Nutrición saludable" class="w-full h-72 object-cover">
    </div>

    <!-- Título principal -->
    <h1 class="text-4xl font-bold text-center mb-6">Todo sobre nutrición saludable</h1>

    <!-- Introducción -->
    <p class="text-lg mb-8 text-center max-w-3xl mx-auto">
      La nutrición es uno de los pilares fundamentales de la salud. Alimentarse correctamente no solo mejora el rendimiento físico, sino también el bienestar emocional, la energía diaria y la prevención de enfermedades. Este artículo explora los conceptos clave de una alimentación equilibrada.
    </p>

    <!-- Sección: Principios básicos -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4">Principios básicos de la nutrición</h2>
      <p class="mb-4">
        Una buena alimentación debe cubrir las necesidades energéticas del cuerpo sin excesos ni carencias. Se basa en la variedad, el equilibrio y la moderación:
      </p>
      <ul class="list-disc list-inside space-y-2">
        <li><strong>Macronutrientes:</strong> proteínas, hidratos de carbono y grasas saludables deben estar presentes en cada comida.</li>
        <li><strong>Micronutrientes:</strong> vitaminas y minerales son esenciales para funciones celulares, inmunidad y metabolismo.</li>
        <li><strong>Hidratación:</strong> el agua cumple funciones vitales en el organismo y debe consumirse en cantidad suficiente cada día.</li>
      </ul>
    </section>

    <!-- Imagen intermedia -->
    <div class="mb-12 rounded-xl overflow-hidden">
      <img src="assets/imagenes/platoFresas.jpg" alt="Dieta equilibrada" class="w-full h-64 object-cover">
    </div>

    <!-- Beneficios + tarjeta -->
    <section class="mb-12 grid md:grid-cols-3 gap-8">
      <div class="md:col-span-2">
        <h2 class="text-2xl font-semibold mb-4">Beneficios de una alimentación saludable</h2>
        <p class="mb-4">
          Comer bien aporta energía estable, mejora la digestión, fortalece el sistema inmunológico y ayuda a mantener un peso adecuado. También influye en la salud mental: una dieta rica en nutrientes mejora la concentración, el ánimo y reduce el riesgo de depresión.
        </p>
        <p>
          A largo plazo, seguir una alimentación equilibrada reduce el riesgo de enfermedades cardiovasculares, diabetes tipo 2, hipertensión y ciertos tipos de cáncer.
        </p>
      </div>
      <aside class="bg-white border-l-4 border-[#0C77F2] p-5 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold mb-2 text-[#0C77F2]">Dato interesante</h3>
        <p class="text-sm text-black">
          Según la OMS, una dieta rica en frutas, verduras y fibras podría prevenir hasta un tercio de las enfermedades coronarias a nivel mundial.
        </p>
      </aside>
    </section>

    <!-- Consejos prácticos -->
    <section class="mb-12">
      <h2 class="text-2xl font-semibold mb-4">Consejos prácticos para mejorar tu nutrición</h2>
      <ul class="list-disc list-inside space-y-2 mb-6">
        <li>Incluye frutas y verduras en todas tus comidas.</li>
        <li>Evita ultraprocesados y azúcares añadidos en exceso.</li>
        <li>Planifica tus menús semanales para evitar decisiones impulsivas.</li>
        <li>Lee las etiquetas de los productos y prioriza ingredientes naturales.</li>
        <li>No te obsesiones con las calorías: prioriza la calidad nutricional.</li>
      </ul>
      <p>
        La clave está en adoptar hábitos sostenibles a largo plazo. No se trata de “hacer dieta”, sino de aprender a comer bien todos los días.
      </p>
    </section>

    <!-- Cierre -->
    <section class="text-center mt-20">
      <h2 class="text-xl font-semibold mb-2">Conclusión</h2>
      <p class="max-w-2xl mx-auto">
        Comer es un acto cotidiano con un gran impacto en tu salud. Elegir alimentos naturales, variados y adaptados a tus necesidades es una forma de autocuidado poderosa. Empieza poco a poco y haz de la nutrición consciente una parte esencial de tu estilo de vida.
      </p>
    </section>

  </main>
</body>
</html>

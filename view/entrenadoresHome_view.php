<?php
require_once("view/menu.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrenadores - FitPro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .trainer-image-container {
      position: relative;
      width: 100%;
      height: 300px;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #e2e8f0;
    }
    .trainer-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
  </style>
</head>
<body class="bg-[#F8FAFC] text-gray-800">

  <!-- Hero con fondo de imagen -->
  <section class="relative h-[350px] md:h-[420px] flex items-center justify-center bg-cover bg-center" style="background-image: url('assets/imagenes/personas-en-clase-reformadora-de-pilates-ejercitando-sus-cuerpos.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-10"></div> <!-- Capa oscura opcional -->
    <div class="relative z-10 text-center text-white px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Conoce a Nuestro Equipo</h1>
      <p class="text-lg max-w-2xl mx-auto">Profesionales apasionados que te acompañan en tu transformación física y personal.</p>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 py-12">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <?php foreach($entrenadores as $entrenador): 
        $imagen_entrenador = "assets/imagenes/entrenadores/" . strtolower(str_replace(' ', '_', $entrenador['nombre'])) . ".jpg";
        $imagen_final = file_exists($imagen_entrenador) ? $imagen_entrenador : "assets/imagenes/entrenador_generico.jpg";
      ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-[#e2e8f0] hover:shadow-lg transition-shadow duration-300">
          <div class="relative">
            <div class="trainer-image-container">
              <img src="<?= $imagen_final ?>" 
                   alt="Foto de <?= htmlspecialchars($entrenador['nombre']) ?>" 
                   class="trainer-image">
            </div>
            <?php if ($entrenador['especialidad']): ?>
              <span class="absolute top-2 right-2 bg-[#0C77F2] text-white px-3 py-1 rounded-full text-sm">
                <?= htmlspecialchars($entrenador['especialidad']) ?>
              </span>
            <?php endif; ?>
          </div>
          <div class="p-6">
            <h2 class="text-xl font-semibold text-[#0C77F2] mb-2"><?= htmlspecialchars($entrenador['nombre']) ?></h2>
            <div class="space-y-2">
              <p class="text-gray-700">
                <i class="fas fa-envelope mr-2"></i>
                <?= htmlspecialchars($entrenador['email']) ?>
              </p>
              <p class="text-gray-700">
                <i class="fas fa-phone mr-2"></i>
                <?= htmlspecialchars($entrenador['telefono']) ?>
              </p>
              <?php if (isset($entrenador['descripcion'])): ?>
                <p class="text-gray-600 text-sm mt-3">
                  <?= htmlspecialchars($entrenador['descripcion']) ?>
                </p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Font Awesome para iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>

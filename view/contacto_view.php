<?php require_once("view/menu.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - FitPro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] text-[#0d141c]">

  <section class="max-w-5xl mx-auto mt-16 mb-20 bg-white rounded-3xl shadow-2xl overflow-hidden text-[#0d141c]">
    <div class="grid md:grid-cols-2">
      
      <!-- Imagen lateral -->
      <div class="bg-cover bg-center hidden md:block" style="background-image: url('assets/imagenes/hombre-de-alto-angulo-haciendo-ejercicio-en-el-gimnasio.jpg'); min-height: 100%;">
      </div>

      <!-- Formulario -->
      <div class="p-8 sm:p-12">
        <h1 class="text-4xl font-extrabold text-[#49709c] text-center mb-6">Contáctanos</h1>

        <?php if (!empty($message)): ?>
          <div class="mb-6 text-center px-4 py-3 rounded-lg font-medium 
                      <?= str_starts_with($message, '✅') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
            <?= $message ?>
          </div>
        <?php endif; ?>

        <form action="" method="post" class="space-y-6 text-[#0d141c]">
          <div>
            <label for="nombre" class="block font-bold mb-1">Nombre</label>
            <input type="text" id="nombre" name="nombre" required
                   class="w-full px-4 py-3 border border-[#49709c] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#49709c] bg-white text-[#0d141c]" />
          </div>

          <div>
            <label for="email" class="block font-bold mb-1">Correo electrónico</label>
            <input type="email" id="email" name="email" required
                   class="w-full px-4 py-3 border border-[#49709c] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#49709c] bg-white text-[#0d141c]" />
          </div>

          <div>
            <label for="mensaje" class="block font-bold mb-1">Mensaje</label>
            <textarea id="mensaje" name="mensaje" rows="5" required
                      class="w-full px-4 py-3 border border-[#49709c] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#49709c] bg-white text-[#0d141c] resize-none"></textarea>
          </div>

          <div class="text-center">
            <button type="submit"
                    class="bg-[#0C77F2] hover:bg-[#095ac2] text-white font-semibold py-3 px-8 rounded-md shadow-md transition duration-200">
              Enviar mensaje
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

</body>
</html>

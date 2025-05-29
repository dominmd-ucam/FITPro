<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FitPro - Iniciar Sesión</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Lexend', sans-serif;
      background-image: url('assets/imagenes/login.jpg');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center bg-[#f8fafc]/90 backdrop-blur-sm px-4 py-10">

  <!-- Logo más grande -->
  <a href="index.php">
    <img src="assets/imagenes/logofitpro.png" alt="Logo FitPro" class="h-32 mb-6 drop-shadow-md">
  </a>

  <!-- Tarjeta de login -->
  <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 space-y-6">
    <div class="text-center">
      <h1 class="text-3xl font-bold text-gray-800">Iniciar sesión</h1>
    </div>

    <!-- Mensaje de error -->
    <?php if (!empty($message)) : ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm text-center font-semibold">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <!-- Formulario -->
    <form action="" method="post" class="space-y-5">
      <div>
        <label for="uname" class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
        <input type="text" name="nombre" id="uname" placeholder="Introduce tu usuario" required
               class="w-full text-black rounded-md border-gray-300 shadow-sm focus:border-[#0C77F2] focus:ring-[#0C77F2]">
      </div>

      <div>
        <label for="pswd" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
        <input type="password" name="pswd" id="pswd" placeholder="Introduce tu contraseña" required
               class="w-full text-black rounded-md border-gray-300 shadow-sm focus:border-[#0C77F2] focus:ring-[#0C77F2]">
      </div>

      <button type="submit" name="submit"
              class="w-full bg-[#0C77F2] text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition">
        Entrar
      </button>

      <p class="text-center text-sm text-gray-600 mt-2">
        ¿No tienes cuenta?
        <a href="index.php?controlador=miembros&action=registrar" class="text-[#0C77F2] font-semibold hover:underline">
          Regístrate aquí
        </a>
      </p>
    </form>
  </div>

</body>
</html>

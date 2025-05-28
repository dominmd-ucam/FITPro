<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>FitMax - Registro</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
      body {
        background-color: #dce5ef;
        font-family: Lexend, "Noto Sans", sans-serif;
      }
      
      .main-card {
        background-color: #f8fafc;
        border-radius: 1.5rem;
        margin: 2rem auto;
        max-width: 1600px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        position: relative;
      }

      .login-header {
        background: url('assets/imagenes/registro.jpg') center center/cover no-repeat, #49709c;
        padding: 2rem;
        border-radius: 1.5rem 1.5rem 0 0;
        position: relative;
        overflow: hidden;
        min-height: 260px;
        display: flex;
        flex-direction: column;
        justify-content: center;
      }
      .login-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(73, 112, 156, 0.6);
        z-index: 1;
        border-radius: 1.5rem 1.5rem 0 0;
      }
      .login-header > .container {
        position: relative;
        z-index: 2;
      }

      .form-input {
        background-color: #ffffff !important;
        color: #0d141c !important;
        border: 1px solid #49709c !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        width: 100%;
        font-size: 1rem;
        transition: all 0.2s;
      }

      .form-input:focus {
        border-color: #0c77f2 !important;
        box-shadow: 0 0 0 2px rgba(12, 119, 242, 0.1) !important;
        outline: none;
      }

      .form-input::placeholder {
        color: #49709c !important;
        opacity: 0.7;
      }

      .btn-primary {
        background-color: #49709c;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: background-color 0.2s;
        border: none;
        cursor: pointer;
        width: 100%;
        font-size: 1rem;
      }

      .btn-primary:hover {
        background-color: #0c77f2;
      }

      .alert-danger {
        background-color: #fee2e2;
        color: #dc2626;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
        text-align: center;
      }

      .login-link {
        color: #49709c;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
      }

      .login-link:hover {
        color: #0c77f2;
      }
    </style>
  </head>
  <body>
    <div class="main-card">
      <div class="login-header">
        <div class="container mx-auto px-4">
          <a href="index.php" class="inline-block">
            <img src="assets/imagenes/logofitpro.png" alt="Logo FitPro" class="h-32">
          </a>
          <h1 class="text-white text-4xl font-bold text-center mt-8">
            Registro
          </h1>
        </div>
      </div>

      <div class="p-8">
        <div class="max-w-md mx-auto">
          <!-- Mensaje de error -->
          <?php if (!empty($message)) : ?>
            <div class="alert-danger">
              <?= htmlspecialchars($message) ?>
            </div>
          <?php endif; ?>

          <!-- Formulario -->
          <form action="" method="post" class="space-y-6">
            <div>
              <label for="uname" class="block text-[#0d141c] text-lg font-bold mb-2">
                Usuario
              </label>
              <input type="text" 
                     class="form-input"
                     id="uname" 
                     name="nombre" 
                     placeholder="Introduce tu usuario" 
                     required>
            </div>

            <div>
              <label for="email" class="block text-[#0d141c] text-lg font-bold mb-2">
                Email
              </label>
              <input type="email" 
                     class="form-input"
                     id="email" 
                     name="email" 
                     placeholder="Introduce tu email" 
                     required>
            </div>

            <div>
              <label for="pswd" class="block text-[#0d141c] text-lg font-bold mb-2">
                Contraseña
              </label>
              <input type="password" 
                     class="form-input"
                     id="pswd" 
                     name="pswd" 
                     placeholder="Introduce tu contraseña" 
                     required>
            </div>

            <button type="submit" name="registro_submit" class="btn-primary">
              Registrarse
            </button>

            <div class="text-center mt-4">
              <span class="text-[#0d141c] font-bold">¿Ya tienes cuenta?</span>
              <a href="index.php?controlador=miembros&action=login" class="login-link ml-2">
                Inicia sesión aquí
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>

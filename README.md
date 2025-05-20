```markdown
# Sistema de Gestión de Gimnasio 🏋️‍♂️

Sistema de gestión integral para gimnasios desarrollado en PHP siguiendo el patrón MVC.

## 📋 Características

- Gestión completa de miembros
- Sistema de membresías
- Control de rutinas y clases
- Seguimiento de progreso
- Planes de nutrición
- Panel de administración
- Interfaz responsiva y moderna

## 🚀 Tecnologías Utilizadas

- PHP 7.4+
- MySQL
- JavaScript
- HTML5
- CSS3 (Tailwind CSS)
- AJAX

## 📦 Instalación

1. Clona el repositorio:
```bash
git clone https://github.com/tu-usuario/gimnasio-mvc.git
```

2. Importa la base de datos:

mysql -u root -p < assets/gimnasio_db.sql

3. Configura la conexión a la base de datos en `model/conectar.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'tu_usuario');
define('DB_PASS', 'tu_contraseña');
define('DB_NAME', 'gimnasio_db');
```

4. Configura tu servidor web (Apache/Nginx) para apuntar al directorio del proyecto.

## 🏗️ Estructura del Proyecto

```
MVC/
├── assets/
│   ├── css/
│   │   ├── headercss.css
│   │   └── login.css
│   └── gimnasio_db.sql
├── controller/
│   ├── dashboard_controller.php
│   ├── front_controller.php
│   └── miembros_controller.php
├── model/
│   ├── conectar.php
│   ├── dashboard_model.php
│   ├── gimnasio_model.php
│   └── miembros_model.php
├── view/
│   ├── dashboard_admin.php
│   ├── dashboard_user.php
│   ├── login_view.php
│   ├── miembros_view.php
│   └── registro_view.php
└── index.php
```

## 📚 Documentación

### Gestión de Miembros

#### Vista de Miembros (`miembros_view.php`)
- Tabla de miembros con información detallada
- Modal para crear nuevos miembros
- Modal de edición con pestañas para:
  - Datos básicos
  - Membresía
  - Rutinas
  - Accesos
  - Progreso
  - Nutrición
  - Clases

#### Controlador de Miembros (`miembros_controller.php`)
```php
// Funciones principales
home()              // Muestra la vista principal
crear_miembro()     // Crea nuevo miembro
get_member_data()   // Obtiene datos del miembro
update_member()     // Actualiza datos del miembro
```

#### Modelo de Miembros (`miembros_model.php`)
```php
// Funciones de base de datos
get_usuarios()          // Lista todos los usuarios
login()                 // Autenticación
usuario_existe()        // Verifica existencia
email_existe()          // Verifica email
registrar_usuario()     // Registra nuevo usuario
get_member_complete_data() // Datos completos
update_member()         // Actualiza miembro
```

### Base de Datos

#### Tablas Principales
```sql
-- Usuarios
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    email VARCHAR(255),
    passwd VARCHAR(255),
    tipo ENUM('cliente', 'admin')
);

-- Membresías
CREATE TABLE membresias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    tipo_id INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado VARCHAR(50)
);
```

### JavaScript

#### Funciones Principales
```javascript
// Gestión de Modales
openModal()          // Abre modal nuevo miembro
closeModal()         // Cierra modal
openEditModal(id)    // Abre modal edición
closeEditModal()     // Cierra modal edición

// Gestión de Datos
saveMember()         // Guarda nuevo miembro
saveEdit()           // Guarda edición
loadTabData(tabId)   // Carga datos de pestaña
```

## 🎨 Estilos

El proyecto utiliza Tailwind CSS para el diseño, con una paleta de colores personalizada:

```css
--primary-color: #1568c1;    /* Azul principal */
--secondary-color: #243547;  /* Azul oscuro */
--text-color: #93adc8;      /* Texto */
--background-color: #111418; /* Fondo */
```

## 🔒 Seguridad

- Validación de datos en servidor y cliente
- Protección contra SQL Injection
- Encriptación de contraseñas
- Control de sesiones
- Validación de permisos de usuario

## 🤝 Contribuir

1. Haz un Fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE.md](LICENSE.md) para más detalles.

## ✨ Características Futuras

- [ ] Sistema de pagos integrado
- [ ] App móvil para miembros
- [ ] Integración con wearables
- [ ] Sistema de reservas online
- [ ] Generación de reportes PDF

## 📞 Soporte

Para soporte, email: tu@email.com o crea un issue en el repositorio.

## 🙏 Agradecimientos

- [Tailwind CSS](https://tailwindcss.com)
- [PHP](https://php.net)
- [MySQL](https://mysql.com)
```

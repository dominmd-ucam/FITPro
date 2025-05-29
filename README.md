# FITPro - Sistema Integral de Gestión de Gimnasios

FITPro es una plataforma moderna de fitness que democratiza el acceso a servicios de fitness de calidad. Combina tecnología, atención personalizada e innovación constante para ofrecer programas integrales adaptados a cada persona.

## 🏋️ Características

FITPro ofrece un ecosistema completo para la gestión de gimnasios y la participación de los miembros:

### Características Principales

* **Autenticación y Gestión de Usuarios**: Sistema seguro de inicio de sesión y registro con gestión de sesiones
* **Programación de Clases**: Gestión completa de clases con asignaciones de entrenadores y registros de usuarios
* **Entrenamiento Personal**: Perfiles profesionales de entrenadores con especializaciones
* **Seguimiento de Progreso**: Monitoreo integral del progreso físico y analíticas
* **Planificación Nutricional**: Planes personalizados de nutrición y seguimiento dietético
* **Chatbot impulsado por IA**: Asistencia inteligente utilizando la API Google Gemini

### Características de Administración

* **Gestión de Miembros**: Administración completa de usuarios y controles de membresía
* **Gestión de Entrenadores**: Administración integral de entrenadores
* **Administración de Clases**: Programar y gestionar clases de fitness

## 🛠️ Tecnología Utilizada

* **Backend**: PHP con arquitectura MVC
* **Frontend**: HTML5, Tailwind CSS, JavaScript
* **Base de Datos**: MySQL/MariaDB
* **Integración de IA**: API Google Gemini
* **Gestión de Sesiones**: Sesiones nativas PHP con middleware de autenticación

## 📁 Estructura del Proyecto

```
FITPro/
├── controller/          # Controladores MVC
├── model/               # Modelos de datos
├── view/                # Plantillas de interfaz de usuario
├── assets/              # Recursos estáticos
├── Documentacion/       # Documentación del proyecto
└── README.md            # Este archivo
```

## 💄 Esquema de la Base de Datos

### Tablas Principales:

* **usuarios**: Gestión de usuarios
* **entrenadores**: Información y especializaciones
* **clases**: Definiciones de clases
* **alimentos**: Base de datos nutricional
* **rutinas**: Rutinas personalizadas
* **progreso\_usuario**: Seguimiento de progreso

## 🚀 Instalación

### Prerrequisitos

* PHP 8.2.4+
* MySQL/MariaDB 10.4.28+
* Servidor web (Apache/Nginx)

### Instrucciones

1. **Clonar el repositorio**

```bash
git clone https://github.com/dominmd-ucam/FITPro.git
cd FITPro
```

2. **Configuración de Base de Datos**

```bash
mysql -u root -p gimnasio_db < assets/gimnasio_db.sql
```

3. **Configurar la Conexión**

* Editar los datos en la capa del modelo

4. **Servidor Web**

* Apuntar al directorio del proyecto
* Revisar configuración de PHP
* Establecer permisos adecuados

## 🎯 Uso

### Acceso a la Aplicación

* Páginas Públicas: Inicio, contacto
* Panel de Miembros
* Panel de Administración

### Rutas por Defecto

* Inicio: `index.php?controlador=home&action=home`
* Inicio de Sesión: `index.php?controlador=miembros&action=login`
* Registro: `index.php?controlador=miembros&action=registrar`

## 🎨 Valores Fundamentales

1. **Cercanía Real**
2. **Innovación con Propósito**
3. **Bienestar Sostenible**

## 📝 Funcionalidades Detalladas

### Sistema de Nutrición

* Base de datos de alimentos e información nutricional

### Seguimiento de Progreso

* Registro de métricas físicas a lo largo del tiempo

### Gestión de Clases

* Programar, ver y registrarse en clases

## 👥 Equipo

Profesionales apasionados: entrenadores certificados, nutricionistas, psicólogos deportivos, fisioterapeutas y desarrolladores.

## 📄 Licencia

Proyecto de desarrollo académico en la Universidad Católica de Murcia (UCAM).

## 🤝 Contribuciones

Para colaborar, contactar con el equipo de desarrollo.

---

**Notas**

Este README se basa en la estructura actual. El sistema es extensible para módulos futuros como facturación, reservas, notificaciones y analíticas.

---

# FITPro - Comprehensive Gym Management System

FITPro is a modern fitness platform that democratizes access to quality fitness services. It combines technology, personalized attention, and constant innovation to offer comprehensive programs adapted to each person.

## 🏋️ Features

FITPro offers a complete ecosystem for gym management and member engagement:

### Core Features

* **User Authentication & Management**
* **Class Scheduling**
* **Personal Training**
* **Progress Tracking**
* **Nutrition Planning**
* **AI-Powered Chatbot**

### Admin Features

* **Member Management**
* **Trainer Management**
* **Class Administration**

## 🛠️ Technology Stack

* **Backend**: PHP with MVC architecture
* **Frontend**: HTML5, Tailwind CSS, JavaScript
* **Database**: MySQL/MariaDB
* **AI Integration**: Google Gemini API
* **Session Management**: PHP native sessions with authentication middleware

## 📁 Project Structure

```
FITPro/
├── controller/          # MVC Controllers
├── model/               # Data models
├── view/                # UI templates
├── assets/              # Static assets
├── Documentacion/       # Documentation
└── README.md            # This file
```

## 💄 Database Schema

### Key Tables:

* **users**
* **trainers**
* **classes**
* **foods**
* **routines**
* **user\_progress**

## 🚀 Installation

### Prerequisites

* PHP 8.2.4+
* MySQL/MariaDB 10.4.28+
* Web server (Apache/Nginx)

### Instructions

1. **Clone Repository**

```bash
git clone https://github.com/dominmd-ucam/FITPro.git
cd FITPro
```

2. **Database Setup**

```bash
mysql -u root -p gimnasio_db < assets/gimnasio_db.sql
```

3. **Configure Connection**

* Update credentials in model layer

4. **Web Server**

* Point server to project directory
* Ensure PHP is configured
* Set file permissions

## 🎯 Usage

### Access

* Public Pages: landing, contact
* Member Dashboard
* Admin Panel

### Default Routes

* Home: `index.php?controlador=home&action=home`
* Login: `index.php?controlador=miembros&action=login`
* Register: `index.php?controlador=miembros&action=registrar`

## 🎨 Core Values

1. **Real Closeness**
2. **Innovation with Purpose**
3. **Sustainable Wellness**

## 📝 Features in Detail

### Nutrition System

* Food database with nutritional info

### Progress Tracking

* Track physical metrics over time

### Class Management

* View, register, and manage class schedules

## 👥 Team

Driven by certified trainers, nutritionists, sport psychologists, physiotherapists, and developers.

## 📄 License

Academic development project at Universidad Católica de Murcia (UCAM).

## 🤝 Contributing

For contributions, contact the development team.

---

**Notes**

This README reflects the current structure. The system is extensible for future modules like billing, reservations, notifications, and analytics.

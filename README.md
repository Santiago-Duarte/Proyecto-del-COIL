<div align="center">

# 🐾 VetControl

### Sistema de Gestión para Clínicas Veterinarias

[![Laravel](https://img.shields.io/badge/Laravel-13.x-ff2d20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![AdminLTE](https://img.shields.io/badge/AdminLTE-3-1c7dc7?style=for-the-badge&logo=bootstrap&logoColor=white)](https://adminlte.io)
[![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![Vite](https://img.shields.io/badge/Vite-8-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

*Dashboard oscuro · Minimalista · Tiempo real*

---

![Status](https://img.shields.io/badge/status-✅_Completo-2ea043?style=flat-square)
![Version](https://img.shields.io/badge/version-1.0.0-blue?style=flat-square)
![License](https://img.shields.io/badge/license-MIT-lightgrey?style=flat-square)

</div>

## ✨ Descripción

**VetControl** es una aplicación web **SPA** para la administración integral de clínicas veterinarias.
Interfaz **oscura y minimalista** inspirada en diseños modernos, con métricas en tiempo real,
CRUD completo de las entidades principales y flujos de trabajo clínicos reales.

> 🎯 **Esencia del proyecto**: que el veterinario pueda ver de un vistazo qué pasa hoy en la clínica
> — cuántas citas hay, cuáles están pendientes y qué mascotas atender — sin ruido ni pantallas saturadas.

<div align="center">

```
   🐕 Registro de dueños    🐈    Historial de mascotas    💉    Agenda de citas
```

</div>

---

## 📸 Vista general

```
┌──────────────────────────────────────────────────────────────┐
│  🐾 VetControl      Dashboard        Lun, Nov 24, 2026  ⏻   │
├──────────┬───────────────────────────────────────────────────┤
│          │                                                   │
│Dashboard │   ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌────────┐  │
│          │   │ 👥 15   │ │ 🐾 30   │ │ 👨‍⚕️ 5    │ │ 📅 50  │  │
│── MANAGE─┤   │ Owners →│ │ Pets →  │ │Vets →   │ │Appts → │  │
│ 🐾 Pets  │   └─────────┘ └─────────┘ └─────────┘ └────────┘  │
│ 👥 Owners│                                                   │
│ 🧑‍⚕️ Vets  │   ┌─── Today's Appointments ──────────── View All ┐│
│ 📅 Appts │   │ 9:00 AM │ Max · Dog · García │ Dr. López │ 🟡  ││
│          │   │10:30 AM │ Luna · Cat · Pérez │ Dr. García│ 🔵  ││
└──────────┴───┴─────────┴──────────────────────────────────────┘
```

---

## 🚀 Instalación

### Requisitos

| Tecnología | Versión |
|------------|---------|
| PHP        | 8.4+    |
| Composer   | 2.x     |
| Node.js    | 18+     |
| SQLite     | 3.x     |

### Pasos

```bash
# 1. Dependencias PHP
composer install

# 2. Entorno
cp .env.example .env
php artisan key:generate
touch database/database.sqlite

# 3. Base de datos con datos de demostración
php artisan migrate:fresh --seed

# 4. Assets (Vite + build)
npm install
npm run build

# 5. ¡Arrancar! 🎉
php artisan serve
```

Abrir → **http://127.0.0.1:8000**

---

## 👤 Acceso

No se siembran usuarios. Regístrate en **`/register`** e inicia sesión en **`/login`**.

<details>
<summary>📦 Datos de demostración (seeder)</summary>

| Entidad        | Cantidad |
|----------------|----------|
| Owners         | 15       |
| Pets           | 30       |
| Veterinarians  | 5        |
| Appointments   | 50       |

</details>

---

## 🗂️ Módulos

### 📊 Dashboard
- Métricas en tiempo real (Owners · Pets · Vets · Appointments)
- Cajas **clickeables** → llevan directo a cada lista
- Tabla de **citas de hoy** con estado visual
- Diseño minimalista: solo lo esencial

### 👥 Owners (Dueños)
- CRUD completo: nombre, teléfono, email, dirección
- Conteo de mascotas por dueño
- Vista de detalle con sus mascotas asociadas

### 🐾 Pets (Mascotas)
- Nombre, especie, raza, fecha de nacimiento, género, color, notas
- Selector de dueño con **Select2**
- Edad calculada automáticamente

### 🧑‍⚕️ Veterinarians
- Nombre, especialidad, teléfono, email
- **Toggle de estado** activo/inactivo vía AJAX
- Conteo de citas por veterinario

### 📅 Appointments (Citas)
- Mascota + Veterinario + Fecha/hora (**Tempusdominus**)
- Estados: `Pending` → `In Consultation` → `Attended`
- **Cambio de estado inline** sin recargar página
- Motivo y notas clínicas

---

## 🛠️ Tecnologías

<div align="center">

| Categoría | Stack |
|-----------|-------|
| **Backend** | Laravel 13 · PHP 8.4 · Eloquent ORM · FormRequests |
| **Frontend** | Blade · Bootstrap 4 · AdminLTE 3 · jQuery |
| **UI/UX** | CSS custom oscuro · Inter font · Font Awesome |
| **Tablas** | DataTables (búsqueda, orden, paginación) |
| **Inputs** | Select2 · Tempusdominus · SweetAlert2 |
| **Gráficos** | Chart.js |
| **Build** | Vite 8 · TailwindCSS 4 · npm |
| **Testing** | PHPUnit 12 · Laravel Pint (code style) |

</div>

---

## 📁 Estructura

```
PROYECTO DEL COIL/
├── app/
│   ├── Http/Controllers/        # 5 controllers (Dashboard + 4 CRUD)
│   ├── Http/Requests/           # Validación con mensajes custom
│   └── Models/                  # Owner, Pet, Veterinarian, Appointment
├── database/
│   ├── factories/               # Datos fake por entidad
│   ├── migrations/              # 4 tablas principales
│   └── seeders/                 # Demo data
├── public/
│   ├── backend/                 # Assets AdminLTE 3
│   └── css/                     # vetcontrol.css (tema oscuro) + auth-dark.css
├── resources/views/
│   ├── layouts/                 # Layout principal + partials
│   ├── dashboard/               # Panel de control
│   ├── owners/ pets/ ...        # Vistas por módulo
│   └── auth/                    # Login / Register
└── routes/web.php               # Rutas (auth middleware)
```

---

## 🔑 Rutas principales

| Ruta | Método | Descripción |
|------|--------|-------------|
| `/login` `/register` | GET/POST | Autenticación |
| `/dashboard` | GET | Panel de control |
| `/owners` | GET | Lista de dueños |
| `/pets` | GET | Lista de mascotas |
| `/veterinarians` | GET | Lista de veterinarios |
| `/appointments` | GET | Lista de citas |

> ⚠️ Todas las rutas de módulos están protegidas con middleware `auth`.

---

## 📧 Recuperar contraseña

`MAIL_MAILER=log` → los correos se escriben en `storage/logs/laravel.log`.

En entorno `local`, el enlace de restablecimiento se muestra directamente en `/password/reset`.
En producción **no** se muestra.

---

## 🧪 Testing

```bash
php artisan test          # Ejecutar tests
vendor/bin/pint           # Formatear código
```

---

<div align="center">

**Hecho con 💙 para clínicas veterinarias**

*VetControl © 2026 · Versión 1.0.0*

</div>

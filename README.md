# Personas Externas y Tipos de Documentos

Aplicación Laravel + AdminLTE 3 con autenticación y dos módulos CRUD.

## Requisitos

- PHP 8.2+ (probado con PHP 8.4)
- Composer
- SQLite (configurado en `.env`)

## Instalación

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
```

No hace falta compilar assets con npm: AdminLTE y sus dependencias se sirven desde `public/vendor`.

## Ejecutar

```bash
php artisan serve
```

Abrir `http://127.0.0.1:8000`.

> En este equipo el puerto 8000 ya está ocupado por otro proceso, por eso la verificación se hizo con:
>
> `php artisan serve --port=8123` → `http://127.0.0.1:8123`

Si cambias de puerto, actualiza también `APP_URL` en `.env`: el enlace de recuperación de contraseña se construye con esa URL.

## Acceso

No se siembran usuarios. Entra a `/register`, crea una cuenta y luego inicia sesión en `/login`.

El seeder deja los 5 tipos de documento de la prueba: CC, NIT, PA, TI y PPT.

## Recuperar contraseña

El correo no se envía a un buzón real: `MAIL_MAILER=log`, así que Laravel escribe el mensaje en `storage/logs/laravel.log`.

Para no depender de un servidor de correo, en el entorno `local` el enlace de restablecimiento se muestra directamente en `/password/reset` después de enviar el formulario. Ese bloque solo aparece con `APP_ENV=local`; en producción no se muestra.

## Rutas principales

- `GET /login`, `GET /register`, `POST /logout`
- `GET /personas-externas` (CRUD)
- `GET /tipos-documentos` (CRUD)

Todas las rutas de los módulos están protegidas con el middleware `auth`.
# Proyecto-del-COIL
# Proyecto-del-COIL

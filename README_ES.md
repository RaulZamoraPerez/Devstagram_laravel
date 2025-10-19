<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

# Devstagram_laravel

Proyecto de ejemplo basado en Laravel que implementa funcionalidades tipo Instagram (posts, comentarios, likes, perfiles). Este README añade instrucciones en español para levantar el proyecto localmente en Windows (PowerShell), comandos útiles (Artisan, Composer, NPM/Vite, Livewire) y notas de configuración.

## Requisitos

- PHP 8.1+ (según la configuración del proyecto).
- Composer
- Node.js 16+ y npm
- MySQL / MariaDB o cualquier base de datos soportada por Laravel
- Extensiones PHP comunes: mbstring, PDO, BCMath, OpenSSL, Fileinfo, ctype, json

Nota: ajusta versiones según tu entorno.

## 1) Clonar y preparar dependencias

Abre PowerShell en la carpeta del proyecto y ejecuta:

```powershell
cd 'c:\Users\Hewlett Packard\Desktop\laravel\Devstagram_laravel'
composer install --no-interaction --prefer-dist
npm install
```

Si usas Yarn:

```powershell
yarn install
```

## 2) Configurar .env

Copia el archivo de ejemplo y ajusta las credenciales de la base de datos y APP_KEY:

```powershell
cp .env.example .env
```

En PowerShell la copia alternativa (si cp no está disponible):

```powershell
Copy-Item -Path .env.example -Destination .env
```

Genera la clave de la aplicación:

```powershell
php artisan key:generate
```

Edita `.env` y configura `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` y otros valores (MAIL, AWS, etc.) según necesites.

## 3) Migraciones y seeders

Ejecuta migraciones y (opcional) seeders para poblar datos de prueba:

```powershell
php artisan migrate
php artisan db:seed
```

Si quieres reiniciar y volver a ejecutar todas las migraciones:

```powershell
php artisan migrate:fresh --seed
```

## 4) Build de assets (Vite)

Para desarrollo con recarga en caliente:

```powershell
npm run dev
```

Para build de producción:

```powershell
npm run build
```

## 5) Servir la aplicación

Levanta el servidor de desarrollo:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Abre http://127.0.0.1:8000 en tu navegador.

## Comandos útiles de Artisan / Composer / NPM

- Ejecutar tests:

```powershell
php artisan test
```

- Limpiar cachés:

```powershell
php artisan route:clear; php artisan config:clear; php artisan view:clear; php artisan cache:clear
```

- Optimizar para producción (config cache, route cache):

```powershell
php artisan config:cache; php artisan route:cache; php artisan view:cache
```

- Composer update/install:

```powershell
composer install
composer update
```

## Livewire (si está instalado)

Este proyecto contiene componentes Livewire. Comandos comunes:

- Generar un componente Livewire:

```powershell
php artisan make:livewire NombreComponente
```

- Si necesitas publicar assets de Livewire (por ejemplo para Alpine/supports):

```powershell
php artisan livewire:publish --assets
```

- Mostrar lista de componentes (no hay comando nativo, pero puedes revisar `resources/views/livewire` y `app/Http/Livewire`)

Notas Livewire:
- Livewire trabaja con Vite y Alpine.js por defecto en instalaciones recientes. Asegúrate de que `resources/js/app.js` importe `@livewire/livewire` si es necesario.
- Si tienes problemas de recarga, reinicia `npm run dev` y verifica la consola del navegador.

## Notas específicas del proyecto

- Rutas principales en `routes/web.php`.
- Controladores principales en `app/Http/Controllers`.
- Modelos: revisa `app/Models` para `Post`, `User`, `Like`, `Comentario`.
- Livewire: componentes en `app/Http/Livewire`.

## Depuración y problemas comunes

- Error de migraciones: revisa que las credenciales en `.env` sean correctas y que el usuario tenga permisos.
- Problemas con permisos de `storage`/`bootstrap/cache`: en Windows normalmente no aplica, pero en Linux/WSL usa `chmod -R 775 storage bootstrap/cache`.
- Errores de paquetes Node: borra `node_modules` y reinstala (`rm -rf node_modules` / `npm ci`). En PowerShell:

```powershell
Remove-Item -Recurse -Force node_modules
npm ci
```

## Cómo contribuir / desarrollo

- Crea una rama por feature: `git checkout -b feature/mi-cambio`.
- Ejecuta tests y lint antes de hacer PR.

## Recursos útiles

- Documentación Laravel: https://laravel.com/docs
- Livewire docs: https://laravel-livewire.com/docs

---

Si quieres, puedo añadir instrucciones específicas para despliegue (Forge, Vapor, Docker) o crear scripts de `Makefile`/`tasks.json` para VSCode. Dime cuál prefieres.

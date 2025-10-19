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

Nota corta: también basta con ejecutar simplemente:

```powershell
php artisan serve
```

Esto iniciará el servidor de desarrollo en el host y puerto por defecto (normalmente http://127.0.0.1:8000). Si el puerto está ocupado, Artisan elegirá otro puerto y lo mostrará en la salida. Para que los assets (CSS/JS) se recarguen automáticamente en desarrollo, abre otro terminal y ejecuta `npm run dev`.

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
# Devstagram_laravel

Proyecto de ejemplo basado en Laravel que implementa funcionalidades tipo Instagram (posts, comentarios, likes y perfiles).

Este README está escrito en Markdown limpio para buena visualización en GitHub y contiene instrucciones básicas para levantar el proyecto en Windows (PowerShell).

---

## Requisitos mínimos

- PHP 8.1+
- Composer
- Node.js 16+ y npm (o Yarn)
- MySQL / MariaDB (u otra BD soportada por Laravel)
- Extensiones PHP habituales: mbstring, PDO, BCMath, OpenSSL, Fileinfo, ctype, json

## Inicio rápido (PowerShell)

1. Abrir PowerShell en la carpeta del proyecto:

```powershell
cd 'C:\Users\Hewlett Packard\Desktop\laravel\Devstagram_laravel'
```

2. Instalar dependencias PHP y JS:

```powershell
composer install --no-interaction --prefer-dist
npm install
# o: yarn install
```

3. Copiar el `.env` y generar la clave:

```powershell
Copy-Item -Path .env.example -Destination .env
php artisan key:generate
```

4. Configurar `.env` (DB, MAIL, etc.) y ejecutar migraciones:

```powershell
php artisan migrate
php artisan db:seed    # opcional
```

5. Ejecutar Vite en desarrollo (para assets con HMR):

```powershell
npm run dev
```

6. Levantar servidor de desarrollo (también puedes usar `php artisan serve` sin argumentos):

```powershell
php artisan serve
# por defecto abre en: http://127.0.0.1:8000
```

---

## Comandos útiles (resumen)

- Ejecutar tests:

```powershell
php artisan test
```

- Limpiar cachés:

```powershell
php artisan route:clear; php artisan config:clear; php artisan view:clear; php artisan cache:clear
```

- Optimizar para producción:

```powershell
php artisan config:cache; php artisan route:cache; php artisan view:cache
```

---

## Livewire

Si el proyecto usa Livewire (revisa `app/Http/Livewire`):

- Crear componente:

```powershell
php artisan make:livewire NombreComponente
```

- Publicar assets de Livewire (si necesario):

```powershell
php artisan livewire:publish --assets
```

Nota: asegúrate de ejecutar `npm run dev` para ver cambios en tiempo real.

---

## Notas sobre `.env` y artefactos

- Nunca subas archivos `.env` reales al repositorio. Usa `.env.example` como plantilla.
- `vendor/`, `node_modules/`, `public/uploads` y `storage/logs` deben estar en `.gitignore` (ya incluidos en este proyecto).

---

## Contribuir

- Crea una rama por feature: `git checkout -b feature/mi-cambio`.
- Haz PRs desde tu fork o rama y ejecuta los tests antes de pedir revisión.

---

Si quieres, puedo:
- Añadir pasos para despliegue (Docker, Forge, Vapor).
- Crear un script PowerShell `scripts/setup.ps1` que automatice instalación + migraciones.

Dime cuál prefieres y lo agrego.

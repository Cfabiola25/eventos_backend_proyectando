<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Instalación y Configuración de Laravel 10

Esta guía explica cómo instalar y ejecutar un proyecto Laravel 10 en un servidor.

## Requisitos previos

- PHP 8.1 o superior
- Composer instalado
- Servidor web (Apache, Nginx, etc.)
- Base de datos (MySQL, PostgreSQL, SQLite, etc.)
- Node.js y npm (para assets frontend)

## Pasos para la instalación

### 1. Clonar el repositorio

```bash
git clone [url-del-repositorio]
cd nombre-del-proyecto

## Instalar dependencias de frontend
npm install
npm run build

## Configurar permisos
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

2. **Navega al directorio** donde deseas instalar Laravel:

    ```bash
    cd /var/www/html
    ```

3. **Instala Laravel** usando Composer:

    ```bash
    composer create-project laravel/laravel nombre_del_proyecto "10.*"
    ```

## Paso 2: Configurar el Entorno

1. **Navega al directorio** de tu proyecto:

    ```bash
    cd nombre_del_proyecto
    ```

2. **Copia el archivo de entorno** `.env.example` a `.env`:

    ```bash
    cp .env.example .env
    ```

3. **Genera una clave de aplicación**:

    ```bash
    php artisan key\:generate
    ```

4. **Configura tu archivo `.env`** con los detalles de tu base de datos y otras configuraciones necesarias.

## Paso 3: Configurar el Servidor Web

### Apache

1. **Configura un nuevo Virtual Host** para tu aplicación Laravel.

2. **Asegúrate de que el módulo `rewrite`** esté habilitado:

    ```bash
    sudo a2enmod rewrite
    ```

3. **Reinicia Apache**:

    ```bash
    sudo systemctl restart apache2
    ```

### Nginx

1. **Configura un nuevo archivo de configuración** para tu sitio en `/etc/nginx/sites-available/`.

2. **Crea un enlace simbólico** a `sites-enabled`:

    ```bash
    sudo ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/
    ```

3. **Reinicia Nginx**:

    ```bash
    sudo systemctl restart nginx
    ```

## Paso 4: Instalar Dependencias y Ejecutar Migraciones

1. **Instala las dependencias de Composer**:

    ```bash
    composer install
    ```

2. **Ejecuta las migraciones** para configurar la base de datos:

    ```bash
    php artisan migrate
    ```

3. **Si es necesario, ejecuta los seeders**:

    ```bash
    php artisan db\:seed
    ```

## Paso 5: Configurar Permisos

1. **Configura los permisos** adecuados para el almacenamiento y la caché:

    ```bash
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
    ```

2. **Asegúrate de que el usuario del servidor web** tenga los permisos adecuados:

    ```bash
    chown -R www-data\:www-data /var/www/html/nombre_del_proyecto
    ```

## Comandos Artisan Útiles

- **Iniciar el servidor de desarrollo**:
    ```bash
    php artisan serve
    ```

- **Limpiar la caché**:
    ```bash
    php artisan cache\:clear
    ```

- **Limpiar la vista en caché**:
    ```bash
    php artisan view\:clear
    ```

- **Limpiar la configuración en caché**:
    ```bash
    php artisan config\:clear
    ```

- **Ejecutar migraciones**:
    ```bash
    php artisan migrate
    ```

- **Ejecutar un seeder específico**:
    ```bash
    php artisan db\:seed --class=NombreDelSeeder
    ```
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Como inciar el proyecto

- clonar el repositorio
- crear una base de datos en mysql
- crear un archivo .env en la raiz del proyecto
- copiar el contenido del archivo .env.example en el archivo .env
- configurar las variables de entorno en el archivo .env
- ejecutar el comando `php artisan migrate:fresh --seed` para crear las tablas y poblar la base de datos
- ejecutar el comando `php artisan serve` para iniciar el servidor
- ingresar a la ruta `localhost:8000` en el navegador

## Informacion 
 - todas las rutas y las funciones del api estan documentadas en swagger en la ruta `localhost:8000/api/documentation`
 - el manejo de excepciones se encuentra en `app/Exceptions/`


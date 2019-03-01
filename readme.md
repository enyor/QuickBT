# QuickBT

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)


QuickBT es un API Rest de prueba desarrollado con el framework Lumen, que contiene las siguientes caracteristicas:

- Respuestas en formato Json
- Previene el consumo de los endpoint desde un navegador convencional
- Valida por medio de token el consumo de los endpoint

Se utilizaron caracteristicas heredadas de Laravel como Migrations, Factories, Encrypt entre otras.

## Sobre el entorno de desarrollo

- Xampp ( PHP 7.3.2, MYSQL, Apache 2.4.38 )
- Composer ( v1.8.4)
- Lumen (5.3)


## Instalación

- Clonar el proyecto desde https://github.com/enyor/QuickBT

- Modificar el archivo .env y colocar los datos de acceso a la Base de datos

- Crear Tabla desde migrations
$ php artisan migrate

- Crear data de prueba desde factories
$ php artisan migrate:refresh --seed

- Iniciar servidor
$ php -S localhost:3000 -t public


## Licencia

jejeje :)

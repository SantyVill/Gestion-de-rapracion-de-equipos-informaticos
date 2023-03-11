<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://guarani.unt.edu.ar/autogestion/_comp/siu/img/logo-transparente.png" width="400"></a></p>

<p align="center">
<h1>TEC-SPIN</h1>
</p>


# **PROYECTO FINAL EN BITBUCKET**

## 1) EJECUTAR EN LA TERMINAL EN LARAGON/WWW :

_git clone https://saab250683@bitbucket.org/saab250683/proyectofinalblue.git_

## 2) INGRESAR AL DIRECTORIO LARAGON/WWW/proyectofinal

## 3) Ejecutar el comando

_composer install_

Esto descargara las librerías de laravel en la carpeta vendor (que no existe).

## 4) Duplicar el archivo env.example y guardar la copia como .env


## 5) Configurar .env - Aqui se realizan configuraciones locales

Si APP_KEY esta vacio, ejecutar en la terminal

_php artisan key:generate_

y APP_KEY aparecera algo parecido a esto

_APP_KEY=base64:ChcJtx+YtUXYRyVSsd1fgxipQ6rmTStABl/w2ppnLrQ=

## 6) Configurar la informacion de la base de datos LOCAL que van a usar

_DB_DATABASE=proyectofinal_

_DB_USERNAME=root_

_DB_PASSWORD=_


## 7) Finalmente ejecutar las migraciones para crear las tablas en la base de datos

_php artisan migrate_


## 8) Para lanzar el sistema utilizando el localhost se puede realizar lo siguiente:
 _php artisan serve --host=localhost_
 
 o si se quiere usar una ip que se encuentre dentro de nuestra red local:
 
 _php artisan serve --host=192.168.1.##_

## Contact

2021 - Tucuman Argentina
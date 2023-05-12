<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://guarani.unt.edu.ar/autogestion/_comp/siu/img/logo-transparente.png" width="400"></a></p>


# **GESTION DE REPARACIÓN DE EQUIPOS INFORMÁTICOS**

## 1) EJECUTAR EN LA TERMINAL EN LARAGON/WWW :

    _git clone https://MarioGY@bitbucket.org/SantyVillagra/proyectofinal.git_

## 2) INGRESAR AL DIRECTORIO LARAGON/WWW/proyectofinal

## 3) Ejecutar el comando

    _composer install_

Esto descargara las librerķas de laravel en la carpeta vendor (que no existe).

## 4) Duplicar el archivo env.example y guardar la copia como .env


## 5) Configurar .env - Aqui se realizan configuraciones locales

Si APP_KEY esta vacio, ejecutar en la terminal

_php artisan key:generate_

y APP_KEY aparecera algo parecido a esto

_APP_KEY=base64:Chc....

## 6) Configurar la informacion de la base de datos LOCAL que van a usar

_DB_DATABASE=proyectofinal_

_DB_USERNAME=root_

_DB_PASSWORD=_


## 7) Finalmente ejecutar las migraciones para crear las tablas en la base de datos

_php artisan migrate_

_php artisan migrate:rollback_ //elimina todas las migraciones de la base de datos (funcion down)

_php artisan migrate:rollback --step=1_ //elimina la śltima migración creada

_php artisan migrate:fresh_ //elimina todas las migraciones y las crea de nuevo. No hace un rollback de nuevo

_php artisan migrate:refresh_ //elimina todas las migraciones y las crea de nuevo. hace rollback 

_php artisan migrate:reset_ //deshace todas las migraciones de la base de datos

_php artisan migrate:refresh_ //es equivalente a usar _php artisan migrate:reset_ y después _php artisan migrate_

## _php artisan migrate:fresh --seed_ //el comando --seed también ejecuta los seeders para llenar la base de datos 
con datos de prueba. Los seeders son archivos que contienen código para insertar datos en la base de datos de forma automatizada. 


## 8) Para lanzar el sistema utilizando el localhost se puede realizar lo siguiente:
 _php artisan serve --host=localhost_
 
 o si se quiere usar una ip que se encuentre dentro de nuestra red local:
 
 _php artisan serve --host=192.168.1.##_
 
## 9) Login de usuario Administrador

Usuario: admin@admin.com
Contraseña: 12345

## 10) Editar Usuario Administrador, por datos de la persona que administrará el sistema
 Una vez iniciada la sesión:
 i)   Hacer click en el Nombre de usuario ("Administrador, admin") 
 ii)  Click en en el boton de editar usuario
 iii) Se ingresan los datos personales del usuario:
     - Nombre y Apellido
     - Correo Electrónico
     - Contraseña

## Contact

2021 - Tucuman Argentina
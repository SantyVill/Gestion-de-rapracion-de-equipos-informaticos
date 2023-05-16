<p align="center"><a href="" target="_blank"><img src="" width="400"></a></p>


# **GESTION DE REPARACIÓN DE EQUIPOS INFORMÁTICOS**

## 1) EJECUTAR EN LA TERMINAL EN LARAGON/WWW :

    $ git clone https://MarioGY@bitbucket.org/SantyVillagra/proyectofinal.git

Esto debe ejecutarse dentro en el directorio de instalación de laragon "../laragon/www/"

## 2) INGRESAR AL DIRECTORIO 

    $ cd laragon/www/proyectofinal

## 3) Ejecutar el comando gestor de dependencias

    $ composer install

Esto descargara las librerķas de laravel en la carpeta vendor (que no existe).

## 4) Duplicar el archivo env.example y guardar la copia como .env

Esto sirve para resguardar los datos inciales del archivo env.example

## 5) Configurar .env - Aqui se realizan configuraciones locales

Si APP_KEY esta vacio, ejecutar en la terminal

    $ php artisan key:generate

y APP_KEY aparecera algo parecido a esto

    APP_KEY=base64:

## 6) Configurar la informacion de la base de datos LOCAL que van a usar

    DB_DATABASE=proyectofinal

    DB_USERNAME=root

    DB_PASSWORD=


## 7) Finalmente ejecutar las migraciones para crear las tablas en la base de datos
 
 Genera las tablas mediante el uso de migraciones:

    $ php artisan migrate
 
 Elimina todas las migraciones de la base de datos (funcion down)
 
    $ php artisan migrate:rollback 

 Para eliminar la śltima migración creada

    $ php artisan migrate:rollback --step=1 

 Para eliminar todas las migraciones y las crea de nuevo. No hace un rollback de nuevo
 
    $ php artisan migrate:fresh 

 Para eliminar todas las migraciones y las crea de nuevo. hace rollback
 
    $ php artisan migrate:refresh  

 Para Deshacer todas las migraciones de la base de datos

    $ php artisan migrate:reset 

 El siguiente comando es equivalente a usar _php artisan migrate:reset_ y después _php artisan migrate:
  
    $ php artisan migrate:refresh

 El comando --seed también ejecuta los seeders para llenar la base de datos con datos de prueba. 
 Los seeders son archivos que contienen código para insertar datos en la base de datos de forma automatizada:

    $ php artisan migrate:fresh --seed 


## 8) Para lanzar el sistema utilizando el localhost se puede realizar lo siguiente:
 
    $ php artisan serve --host=localhost
 
 o si se quiere usar una ip que se encuentre dentro de nuestra red local:
 
    $ php artisan serve --host=192.168.1.##
 
 NOTA: Los numerales indican los octales correspondientes a la ip del equipo servicor 
 
## 9) Login de usuario Administrador

    Usuario: admin@admin.com

    Contraseña: 12345

## 10) Editar Usuario Administrador, por datos de la persona que administrará el sistema

### Una vez iniciada la sesión:
 ### i)   Hacer click en el Nombre de usuario ("Administrador, admin") 
 ### ii)  Click en en el boton de editar usuario
 ### iii) Se ingresan los datos personales del usuario:
     - Nombre y Apellido
     - Correo Electrónico
     - Contraseña

## Contact

2021 - Tucumán Argentina
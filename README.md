<p align="center"><a href="" target="_blank"><img src="" width="400"></a></p>


# **GESTIÓN DE REPARACIÓN DE DISPOSITIVOS INFORMÁTICOS**

## 1) Ejecutar en la terminal:

    $ git clone https://github.com/SantyVill/Gestion-de-rapracion-de-equipos-informaticos.git

Esto debe ejecutarse dentro en el directorio de instalación de laragon "../laragon/www/"

## 2) Ingresar al directorio 

    $ cd laragon/www/proyectofinal

## 3) Ejecutar el comando gestor de dependencias

    $ composer install

Esto descargará las librerías de laravel en la carpeta vendor (la cual no existe).

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


## 7) Ejecución de las migraciones con seeders 
 
    $ php artisan migrate:fresh --seed 

 El comando --seed también ejecuta los seeders para llenar la base de datos con datos de prueba. 
 Los seeders son archivos que contienen código para insertar datos en la base de datos de forma automatizada:


## 8) Para lanzar el sistema utilizando el localhost se puede realizar lo siguiente:
 
    $ php artisan serve --host=localhost
 
 o si se quiere usar una ip que se encuentre dentro de nuestra red local:
 
    $ php artisan serve --host=192.168.1.##
 
 NOTA: Los numerales indican los octales correspondientes a la ip del equipo servicor 
 
## 9) Login de usuario Administrador

    Usuario: admin@admin.com

    Contraseña: 12345

## 10) Editar Usuario Administrador, por datos de la persona que administrará el sistema

## Una vez iniciada la sesión:
    i)   Hacer click en el Nombre de usuario ("Administrador, admin") 
    ii)  Click en en el boton de editar usuario
    iii) Se ingresan los datos personales del usuario:
     - Nombre y Apellido
     - Correo Electrónico
     - Contraseña

## Contact

2021 - Tucumán Argentina

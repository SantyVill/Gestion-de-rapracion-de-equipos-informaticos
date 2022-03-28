<?php

use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\SesionesController;
//use App\Http\Controllers\RecepcionesController;
//use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

/* Route::get('/equipos',[App\Http\Controllers\EquiposController::class, 'index'])-> name('equipos.index'); */
/*Route::get('/clientes',[App\Http\Controllers\ClientesController::class, 'index'])-> name('clientes.index');*/

Route::resource('equipos', EquiposController::class);/* Crea todas las rutas del controlador de equipos. Para que funcione descomentar la linea 29 de app\Providers\RouteServiceProvider.php   https://www.youtube.com/watch?v=fb4GfNvEf8M&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16*/

Route::resource('clientes', ClientesController::class);
Route::get('cliente/create/{equipo?}',[App\Http\Controllers\ClientesController::class,'create'])->name('clientes.create'); //la ruta tambien recibe un equipo
Route::get('cliente/index/{equipo?}',[App\Http\Controllers\ClientesController::class,'index'])->name('clientes.index'); //la ruta tambien recibe un equipo

Route::resource('recepciones', RecepcionesController::class);
Route::get('/create/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'create'])->name('recepciones.create');
Route::post('/store/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'store'])->name('recepciones.store');

Route::get('/login',[SesionesController::class,'create'])->name('login.index');
Route::post('/login',[SesionesController::class,'store'])->name('login.store');
Route::get('/login/destroy',[SesionesController::class,'destroy'])->name('login.destroy');
Route::get('/registro',[RegistrosController::class,'create'])->name('registro.index');
Route::post('/registro',[RegistrosController::class,'store'])->name('registro.store');


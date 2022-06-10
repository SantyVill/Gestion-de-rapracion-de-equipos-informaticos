<?php

use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\SesionesController;
//use App\Http\Controllers\RevisionesController;
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

/*=============== Rutas de equipos ===============*/
Route::get('equipos/select_recepcion',[App\Http\Controllers\EquiposController::class,'select_equipo_recepcion'])->name('equipos.select_recepcion')->middleware(['logueo','recepcionista']);
Route::get('equipos/update_recepcion',[App\Http\Controllers\EquiposController::class,'update_equipo_recepcion'])->name('equipos.update_recepcion')->middleware(['logueo','recepcionista']);
Route::resource('equipos', EquiposController::class)->middleware(['logueo','recepcionista']);/* Crea todas las rutas del controlador de equipos. Para que funcione descomentar la linea 29 de app\Providers\RouteServiceProvider.php   https://www.youtube.com/watch?v=fb4GfNvEf8M&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16*/

/*=============== Rutas de clientes ===============*/
Route::get('clientes/select_recepcion',[App\Http\Controllers\ClientesController::class,'select_cliente_recepcion'])->name('clientes.select_recepcion')->middleware(['logueo','recepcionista']);
Route::resource('clientes', ClientesController::class)->middleware(['auth'])->middleware(['auth','recepcionista']);
Route::get('cliente/create/{equipo?}',[App\Http\Controllers\ClientesController::class,'create'])->name('clientes.create')->middleware(['logueo','recepcionista']); //la ruta tambien recibe un equipo
Route::get('cliente/index/{equipo?}',[App\Http\Controllers\ClientesController::class,'index'])->name('clientes.index')->middleware(['logueo','recepcionista']); //la ruta tambien recibe un equipo

/*=============== Rutas de recepciones ===============*/
Route::get('/recepciones/informe_final/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'add_informe_final'])->name('recepciones.informe_final')->middleware(['logueo','recepcionista']);
Route::get('/recepciones/create/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'create'])->name('recepciones.create')->middleware(['logueo','recepcionista']);
Route::post('/recepciones/store/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'store'])->name('recepciones.store')->middleware(['logueo','recepcionista']);
Route::get('/recepciones/index/',[App\Http\Controllers\RecepcionesController::class,'index'])->name('recepciones.index');
Route::patch('/recepciones/update/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'update'])->name('recepciones.update');
Route::get('/recepciones/edit/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'edit'])->name('recepciones.edit');
Route::get('/recepciones/show/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'show'])->name('recepciones.show');
Route::delete('/recepciones/destroy/',[App\Http\Controllers\RecepcionesController::class,'destroy'])->name('recepciones.destroy');
/* Route::resource('recepciones', RecepcionesController::class)->middleware(['logueo']);
 */
/*=============== Rutas de logueo ===============*/
Route::get('/login',[SesionesController::class,'create'])->name('login.index');
Route::post('/login',[SesionesController::class,'store'])->name('login.store');
Route::get('/login/destroy',[SesionesController::class,'destroy'])->name('login.destroy');

/*=============== Rutas de registro de usuarios ===============*/
Route::resource('usuarios', UsuariosController::class)->middleware(['logueo','admin']);
/* Route::get('/registro/lista',[RegistrosController::class,'index'])->name('registros.index');
Route::get('/registro/show/{user?}',[RegistrosController::class,'show'])->name('registros.show');
Route::get('/registro/edit/{user}',[RegistrosController::class,'edit'])->name('registros.edit');
Route::get('/registro',[RegistrosController::class,'create'])->name('registros.create');
Route::post('/registro',[RegistrosController::class,'store'])->name('registros.store');
Route::patch('/registro/update',[RegistrosController::class,'update'])->name('registros.update');
Route::delete('/registro/{user}',[RegistrosController::class,'destroy'])->name('registros.destroy'); */

/*=============== Rutas de Lista de precios ===============*/
Route::resource('precios', PreciosController::class);
Route::get('/precios/create/{caracteristica?}',[App\Http\Controllers\PreciosController::class,'create'])->name('precios.create');
Route::post('/precios/store/{caracteristica?}/',[App\Http\Controllers\PreciosController::class,'store'])->name('precios.store');

/*=============== Rutas de Revisiones ===============*/
Route::resource('revisiones', RevisionesController::class);
Route::post('/revisiones/store/{recepcion}',[App\Http\Controllers\RevisionesController::class,'store'])->name('revisiones.store');
Route::get('/revisiones/create/{recepcion}',[App\Http\Controllers\RevisionesController::class,'create'])->name('revisiones.create');

/*=============== Rutas de Lista de precios ===============*/
Route::resource('marcas', MarcasController::class);

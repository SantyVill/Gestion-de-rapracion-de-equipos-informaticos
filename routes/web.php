<?php

use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\SesionesController;
//use App\Http\Controllers\RevisionesController;
//use App\Http\Controllers\RecepcionesController;
//use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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


Route::get('/',[App\Http\Controllers\HomeController::class,'index'])->name('home')->middleware('auth');

/* Route::get('/equipos',[App\Http\Controllers\EquiposController::class, 'index'])-> name('equipos.index'); */
/*Route::get('/clientes',[App\Http\Controllers\ClientesController::class, 'index'])-> name('clientes.index');*/

/*=============== Rutas de equipos ===============*/
Route::get('equipos/select_recepcion',[App\Http\Controllers\EquiposController::class,'select_equipo_recepcion'])->name('equipos.select_recepcion')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('equipos/update_recepcion/{recepcion}',[App\Http\Controllers\EquiposController::class,'update_equipo_recepcion'])->name('equipos.update_recepcion')->middleware(['logueo','rol:recepcionista,admin']);
/* Route::resource('equipos', EquiposController::class)->middleware(['logueo','rol:admin,recepcionista']);/* Crea todas las rutas del controlador de equipos. Para que funcione descomentar la linea 29 de app\Providers\RouteServiceProvider.php   https://www.youtube.com/watch?v=fb4GfNvEf8M&list=PLpKWS6gp0jd_uZiWmjuqLY7LAMaD8UJhc&index=16*/
Route::get('/equipos/create/',[App\Http\Controllers\EquiposController::class,'create'])->name('equipos.create')->middleware(['logueo','rol:recepcionista,admin']);
Route::post('/equipos/store/',[App\Http\Controllers\EquiposController::class,'store'])->name('equipos.store')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/equipos/index/',[App\Http\Controllers\EquiposController::class,'index'])->name('equipos.index')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::patch('/equipos/update/{equipo}',[App\Http\Controllers\EquiposController::class,'update'])->name('equipos.update')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/equipos/edit/{equipo}',[App\Http\Controllers\EquiposController::class,'edit'])->name('equipos.edit')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/equipos/show/{equipo}',[App\Http\Controllers\EquiposController::class,'show'])->name('equipos.show')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::delete('/equipos/destroy/{equipo}',[App\Http\Controllers\EquiposController::class,'destroy'])->name('equipos.destroy')->middleware(['logueo','rol:recepcionista,admin']);

/*=============== Rutas de clientes ===============*/
Route::get('clientes/select_recepcion',[App\Http\Controllers\ClientesController::class,'select_cliente_recepcion'])->name('clientes.select_recepcion')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('clientes/update_recepcion/{recepcion}',[App\Http\Controllers\ClientesController::class,'update_cliente_recepcion'])->name('clientes.update_recepcion')->middleware(['logueo','rol:recepcionista,admin']);
/* Route::resource('clientes', ClientesController::class)->middleware(['logueo','rol:recepcionista,admin']); */
Route::get('/clientes/create/',[App\Http\Controllers\ClientesController::class,'create'])->name('clientes.create')->middleware(['logueo','rol:recepcionista,admin']);
Route::post('/clientes/store/',[App\Http\Controllers\ClientesController::class,'store'])->name('clientes.store')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/clientes/index/',[App\Http\Controllers\ClientesController::class,'index'])->name('clientes.index')->middleware(['logueo','rol:recepcionista,admin']);
Route::patch('/clientes/update/{cliente}',[App\Http\Controllers\ClientesController::class,'update'])->name('clientes.update')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/clientes/edit/{cliente}',[App\Http\Controllers\ClientesController::class,'edit'])->name('clientes.edit')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/clientes/show/{cliente}',[App\Http\Controllers\ClientesController::class,'show'])->name('clientes.show')->middleware(['logueo','rol:recepcionista,admin']);
Route::delete('/clientes/destroy/{cliente}',[App\Http\Controllers\ClientesController::class,'destroy'])->name('clientes.destroy')->middleware(['logueo','rol:recepcionista,admin']);

/*=============== Rutas de recepciones ===============*/
Route::get('/recepciones/informe_final/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'add_informe_final'])->name('recepciones.informe_final')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/recepciones/create/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'create'])->name('recepciones.create')->middleware(['logueo','rol:recepcionista,admin']);
Route::post('/recepciones/store/{equipo?}/{cliente?}/',[App\Http\Controllers\RecepcionesController::class,'store'])->name('recepciones.store')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/recepciones/index/',[App\Http\Controllers\RecepcionesController::class,'index'])->name('recepciones.index')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
/* Route::get('/recepciones/index/{buscar?}/{NumOrden?}',[App\Http\Controllers\RecepcionesController::class,'index'])->name('recepciones.index')->middleware(['logueo']); */
Route::patch('/recepciones/update/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'update'])->name('recepciones.update')->middleware(['logueo','rol:recepcionista,admin']);
Route::patch('/recepciones/informe/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'agregarInforme'])->name('recepciones.agregarInforme')->middleware(['logueo','rol:tecnico,admin']);
Route::get('/recepciones/edit/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'edit'])->name('recepciones.edit')->middleware(['logueo','rol:recepcionista,admin']);
Route::get('/recepciones/show/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'show'])->name('recepciones.show')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::delete('/recepciones/destroy/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'destroy'])->name('recepciones.destroy')->middleware(['logueo','rol:recepcionista,admin']);

Route::get('/recepciones/generar-pdf-ingreso/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'generarPdfIngreso'])->name('recepciones.generarPdfIngreso')->middleware(['logueo','rol:admin,recepcionista']);
Route::get('/recepciones/generar-pdf-informe/{recepcion}',[App\Http\Controllers\RecepcionesController::class,'generarPdfInforme'])->name('recepciones.generarPdfInforme')->middleware(['logueo','rol:admin,recepcionista']);
/* Route::resource('recepciones', RecepcionesController::class)->middleware(['logueo']);
 */
/*=============== Rutas de logueo ===============*/
Route::get('/login',[SesionesController::class,'create'])->name('login.index')->middleware('logueado');
Route::post('/login',[SesionesController::class,'store'])->name('login.store');
Route::get('/login/destroy',[SesionesController::class,'destroy'])->name('login.destroy');

/*=============== Rutas de registro de usuarios ===============*/
Route::resource('usuarios', UsuariosController::class)->middleware(['logueo','rol:admin']);
Route::get('/usuarios/{usuario}',[App\Http\Controllers\UsuariosController::class,'show'])->name('usuarios.show')->middleware(['logueo','mi_perfil'])->withoutMiddleware(['logueo','rol:admin']);
Route::get('/usuarios/edit/{usuario}',[App\Http\Controllers\UsuariosController::class,'edit'])->name('usuarios.edit')->middleware(['logueo','mi_perfil'])->withoutMiddleware(['logueo','rol:admin']);
Route::patch('/usuarios/update/{usuario}',[App\Http\Controllers\UsuariosController::class,'update'])->name('usuarios.update')->middleware(['logueo','mi_perfil'])->withoutMiddleware(['logueo','rol:admin']);
/* Route::get('/registro/lista',[RegistrosController::class,'index'])->name('registros.index'); */
/* Route::get('/registro',[RegistrosController::class,'create'])->name('registros.create');
Route::post('/registro',[RegistrosController::class,'store'])->name('registros.store');
Route::patch('/registro/update',[RegistrosController::class,'update'])->name('registros.update');
Route::delete('/registro/{user}',[RegistrosController::class,'destroy'])->name('registros.destroy'); */

/*=============== Rutas de Revisiones ===============*/
/* Route::resource('revisiones', RevisionesController::class)->middleware(['logueo']); */
Route::get('/revisiones/create/{recepcion}',[App\Http\Controllers\RevisionesController::class,'create'])->name('revisiones.create')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::post('/revisiones/store/{recepcion}/',[App\Http\Controllers\RevisionesController::class,'store'])->name('revisiones.store')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
/* Route::get('/revisiones/index/',[App\Http\Controllers\RevisionesController::class,'index'])->name('revisiones.index')->middleware(['logueo']); */
/* Route::get('/revisiones/index/{buscar?}/{NumOrden?}',[App\Http\Controllers\RevisionesController::class,'index'])->name('revisiones.index')->middleware(['logueo']); */
Route::patch('/revisiones/update/{revision}',[App\Http\Controllers\RevisionesController::class,'update'])->name('revisiones.update')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::get('/revisiones/edit/{revision}',[App\Http\Controllers\RevisionesController::class,'edit'])->name('revisiones.edit')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
/* Route::get('/revisiones/show/{revision}',[App\Http\Controllers\RevisionesController::class,'show'])->name('revisiones.show')->middleware(['logueo']); */
Route::delete('/revisiones/destroy/{revision}',[App\Http\Controllers\RevisionesController::class,'destroy'])->name('revisiones.destroy')->middleware('logueo','rol:recepcionista,admin,tecnico');

/*=============== Rutas de Lista de precios ===============*/
Route::resource('precios', PreciosController::class)->middleware(['logueo','rol:admin']);
/* Route::get('/precios/create/{caracteristica?}',[App\Http\Controllers\PreciosController::class,'create'])->name('precios.create')->middleware(['logueo','rol:admin']);
Route::post('/precios/store/{caracteristica?}/',[App\Http\Controllers\PreciosController::class,'store'])->name('precios.store')->middleware(['logueo','rol:admin']);
Route::post('/precios/store/{caracteristica?}/',[App\Http\Controllers\PreciosController::class,'store'])->name('precios.store')->middleware(['logueo','rol:admin']); */

/*=============== Rutas de Marcas ===============*/
Route::get('/marcas/create/',[App\Http\Controllers\MarcasController::class,'create'])->name('marcas.create')->middleware(['logueo','rol:admin']);
Route::post('/marcas/store/',[App\Http\Controllers\MarcasController::class,'store'])->name('marcas.store')->middleware(['logueo','rol:admin']);
Route::get('/marcas/index/',[App\Http\Controllers\MarcasController::class,'index'])->name('marcas.index')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::patch('/marcas/update/{marca}',[App\Http\Controllers\MarcasController::class,'update'])->name('marcas.update')->middleware(['logueo','rol:admin']);
Route::get('/marcas/edit/{marca}',[App\Http\Controllers\MarcasController::class,'edit'])->name('marcas.edit')->middleware(['logueo','rol:admin']);
Route::get('/marcas/show/{marca}',[App\Http\Controllers\MarcasController::class,'show'])->name('marcas.show')->middleware(['logueo','rol:recepcionista,admin,tecnico']);
Route::delete('/marcas/destroy/{marca}',[App\Http\Controllers\MarcasController::class,'destroy'])->name('marcas.destroy')->middleware(['logueo','rol:admin']);;

/*=============== Rutas de Modelos ===============*/
Route::resource('modelos', ModelosController::class)->middleware(['logueo','rol:admin,recepcionista']);
Route::get('/modelos/create/{marca}',[App\Http\Controllers\ModelosController::class,'create'])->name('modelos.create')->middleware(['logueo','rol:admin']);;
Route::post('/modelos/store/{marca}',[App\Http\Controllers\ModelosController::class,'store'])->name('modelos.store')->middleware(['logueo','rol:admin']);;



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* ============== Rutas de recuperacion de contraseña ===================*/
Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware(['logueado']);
Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware(['logueado']);
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware(['logueado']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update')->middleware(['logueado']);
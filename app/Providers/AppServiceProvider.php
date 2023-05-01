<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        /* \Route::resourceVerbs([
            'create'=>'crear',
            'edit'=>'editar'
        ]); */
        /* USUARIO */
        Config::set('tam_email',150);
        Config::set('tam_rol',20);
        /* CLIENTE */
        Config::set('tam_nombre',100);
        Config::set('tam_apellido',100);
        Config::set('tam_dni',11);
        Config::set('tam_telefono',16);
        Config::set('tam_direccion',150);
        Config::set('tam_mail',150);
        /* EQUIPO */
        Config::set('tam_modelo',40);
        Config::set('tam_tipo',20);
        Config::set('tam_marca',40);
        Config::set('tam_numSerie',50);
        /* RECEPCION */
        Config::set('tam_estado',30);
        Config::set('tam_falla',100);
        Config::set('tam_accesorio',100);
        /* PRECIO */
        Config::set('tam_riesgo',30);
        Config::set('tam_plazo',11);
        Config::set('tam_precio',9);
        Config::set('tam_reparacion',9);
    }
}

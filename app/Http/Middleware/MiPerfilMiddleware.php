<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MiPerfilMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) 
    {
        if (auth()->user()->esAdmin() || auth()->user()->id==$request['usuario']) { /* Comprueba que sea el administrador o que el perfil coincida con el usuario propietario */
            return $next($request);
        }
        return redirect()->back()->with('message','No tienes los permisos para acceder a esta ruta.');
    }
}

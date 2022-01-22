<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Models\Rol;


class RegistrosController extends Controller
{
    public function create(){
        return view('autenticacion.registro');
    }

    public function store(Request $request)
    {
        $field=request()->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required|email',
            'password'=>['required',Rules\password::min(4)],
            'password_confirmar'=>'required|same:password',
        ]);
        $user = User::create($field);
        if ($request->tecnico=='on') {
            $rol = Rol::get()->where('rol','=','tecnico');
            $user->roles()->attach($rol);
        }
        if ($request->recepcionista=='on') {
            $rol = Rol::get()->where('rol','=','recepcionista');
            $user->roles()->attach($rol);
        }
        /* Auth::loginUsingId($user->id); */
        return redirect()->route('home');
    }
}

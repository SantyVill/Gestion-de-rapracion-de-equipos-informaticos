<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;


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
        /* Auth::loginUsingId($user->id); */
        return redirect()->route('home');
    }
}

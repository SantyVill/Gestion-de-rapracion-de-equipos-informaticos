<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SesionesController extends Controller
{
    public function create(){
        return view('autenticacion.login');
    }

    public function store(Request $request){
        /* $user = request()->validate([
            'mail'=> 'required|email',
            'password'=> 'required',
        ]);
        if (auth()->attempt(request(['mail','password']))==false) {
            return back()->withErrors([
                'message' => "Email o la contraseña incorrecta: ".request()->mail."  ".request()->password
            ]);
        }
        return redirect()->route('home'); */


        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'message' => 'Email o la contraseña incorrecta',
        ]);

        /* $credentials = [
            'email' => request('email'),
            'password' => request('password'),
        ];

        if (Auth::attempt($credentials)) {
            return 'estas logueado';
        }

        return 'Falla al loguear'; */
    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('home');
    }
}

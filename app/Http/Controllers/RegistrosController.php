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
    public function index(){
        $users = User::get();
        return view('usuarios.index',compact('users'));
    }

    public function show(User $user){
        return view('usuarios.show',compact('user'));
    }

    public function edit(User $user){
        /* return $user->roles; */
        return view('usuarios.edit',compact('user'));
    }

    public function update(Request $request,User $user){
        $user = User::find($request->id);
        $user['nombre']=request('nombre');
        $user['apellido']=$request['apellido'];
        $user['email']=$request['email'];
        if ($request->tecnico=='on') {
            if (!($user->esTecnico())) {
                $rol = Rol::get()->where('rol','=','tecnico');
                $user->roles()->attach($rol);
            }
        } else {
            $user->roles()->detach(Rol::get()->where('rol','=','tecnico'));
        }
        if ($request->recepcionista=='on' ) {
            if (!($user->esRecepcionista())) {
                $rol = Rol::get()->where('rol','=','recepcionista');
                $user->roles()->attach($rol);
            }
        } else {
            $user->roles()->detach(Rol::get()->where('rol','=','recepcionista'));
        }

        if ($request->password!='') {
            $user->password=$request->password;
        }
        $user->save();
        return redirect()->route('registros.show',$user);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('registros.index');
    }
}

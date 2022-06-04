<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

use App\Models\Rol;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar=$request['buscar'];
        $users=User::where('nombre','like','%'.$buscar.'%')
        ->orwhere(
            'apellido','like','%'.$buscar.'%'
        )
        ->orwhere(
            'email','like','%'.$buscar.'%'
        )
        ->orwhereRelation(
            'roles', 'rol', 'like' ,'%'.$buscar.'%'
        )
        ->paginate(10);
        return view('usuarios.index',compact('users','buscar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autenticacion.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        /* foreach ($user->revisiones as $revision) {
            return $revision;
        }*/
        /* return $user->recepciones; */
        return view('usuarios.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('usuarios.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        return redirect()->route('usuarios.show',$user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('usuarios.index');
    }
}

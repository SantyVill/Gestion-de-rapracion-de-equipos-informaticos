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
        $users=User::listarUsuarios($buscar);
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
        try {
            $field=request()->validate([
                'nombre'=>'required|max:'.config("tam_nombre"),
                'apellido'=>'required|max:'.config("tam_apellido"),
                'email'=>'required|email|max:'.config("tam_email"),
                'password'=>['required',Rules\password::min(4),'max:255'],
                'password_confirmar'=>'required|same:password|max:255',
            ]);
            $field['nombre']=ucfirst($field['nombre']);
            $field['apellido']=ucfirst($field['apellido']);
            $field['password']=bcrypt($field['password']);
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
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
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
        try {
            $user = User::find($id);
            if (!auth()->user()->tieneRol(['admin'])) {
                if ($request->password!='') {
                    request()->validate([
                        'password'=>[Rules\password::min(4),'max:255'],
                    ]);
                    $user->password=bcrypt($request->password);
                    $user->save();
                }
                if (isset($request['nombre'])||isset($request['apellido'])||isset($request['email'])) {
                    return redirect()->route('usuarios.show',$user)->with('message','No tienes permisos para modificar tus datos (solo puedes cambiar tu contraseña).');
                }
                return redirect()->route('usuarios.show',$user);
            }
            request()->validate([
                'nombre'=>'required|max:'.config("tam_nombre"),
                'apellido'=>'required|max:'.config("tam_apellido"),
                'email'=>'required|email|max:'.config("tam_email"),
            ]);
            $user['nombre']=ucfirst(request('nombre'));
            $user['apellido']=ucfirst($request['apellido']);
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
                request()->validate([
                    'password'=>[Rules\password::min(4),'max:255'],
                ]);
                $user->password=bcrypt($request->password);
            }
            $user->save();
            return redirect()->route('usuarios.show',$user);
        } catch (\Illuminate\Database\QueryException $e) {
            $mensaje = 'Se ha producido un error al intentar cargar los datos';
            return redirect()->back()->with('message', $mensaje);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id!=1) {   
            $user = User::find($id);
            $user->delete();
        }
        return redirect()->route('usuarios.index');
    }
}

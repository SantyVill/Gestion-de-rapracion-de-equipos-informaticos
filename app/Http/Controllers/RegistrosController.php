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
    }

    public function store(Request $request)
    {
    }
    public function index(){
    }

    public function show(User $user){
    }

    public function edit(User $user){
        /* return $user->roles; */
    }

    public function update(Request $request,User $user){
    }

    public function destroy($id){
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion uno a muchos: https://www.youtube.com/watch?v=G0B6v-dfhIU&t=1104s
    // Relacion muchos a muchos: https://www.youtube.com/watch?v=i2kHe8noduU
    public function roles(){
        return $this->belongsToMany('App\Models\Rol');
    }
    public function recepciones(){
        return $this->belongsToMany('App\Models\Recepcion','revisions','tecnico_id','recepcion_id');
    }
    public function revisiones(){
        return $this->hasMany('App\Models\Revision','tecnico_id');
    }
    /* public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }  */

    public function tieneRol($roles){
        foreach ($this->roles as $rol) {
            foreach ($roles as $rol_) {
                if ($rol->rol == $rol_) {
                    return true;
                }
            }
        }
        return false;
    }

    public function esAdmin(){
        foreach ($this->roles as $rol) {
            if ($rol->rol == "admin") {
                return true;
            }
        }
        return false;
    }

    public function esTecnico(){
        foreach ($this->roles as $rol) {
            if ($rol->rol == "tecnico") {
                return true;
            }
        }
        return false;
    }
    public function esRecepcionista(){
        foreach ($this->roles as $rol) {
            if ($rol->rol == "recepcionista") {
                return true;
            }
        }
        return false;
    }
}

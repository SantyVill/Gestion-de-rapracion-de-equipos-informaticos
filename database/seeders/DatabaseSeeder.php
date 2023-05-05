<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\User;
use App\Models\Estado;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        Rol::create(['rol'=>'admin']);
        Rol::create(['rol'=>'tecnico']);
        Rol::create(['rol'=>'recepcionista']);
        
        User::create(['apellido'=>'administrador',
                        'nombre'=>'admin',
                        'email'=>'admin@admin.com',
                        'password'=>bcrypt('12345')]);

        DB::table('rol_user')->insert([
            'user_id'=>1,
            'rol_id'=>1
        ]);
        DB::table('rol_user')->insert([
            'user_id'=>1,
            'rol_id'=>2
        ]);
        DB::table('rol_user')->insert([
            'user_id'=>1,
            'rol_id'=>3
        ]);
        Estado::insert([
            ['estado' => 'A presupuestar'],
            ['estado' => 'En Revisión'],
            ['estado' => 'Presupuesto Realizado'],
            ['estado' => 'Presupuesto Aceptado'],
            ['estado' => 'En Reparación'],
            ['estado' => 'Reparación Terminada'],
            ['estado' => 'Equipo Entregado']
        ]);
    }
}

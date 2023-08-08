<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Area;
use App\Models\Instructor;
use App\Models\Recurso;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\AcceptHeader;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Usuario::create([
            'usua_nombre' => 'Juan',
            'usua_apellido' => 'Mamani Peres',
            'usua_documento_tipo' => 'DNI',
            'usua_documento_nro' => '74859632',
            'usua_email' => 'juan@gmail.com',
            'usua_password' => 'password',
            'usua_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);

        $this->call(ActividadSeeder::class);


        Usuario::factory()->count(10)->create();
        User::factory()->count(1)->create();
        Instructor::factory()->count(10)->create();
    }
}

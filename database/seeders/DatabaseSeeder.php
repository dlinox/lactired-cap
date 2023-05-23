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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Usuario::factory()->count(10)->create();
        Tipo::factory()->count(10)->create();
        Area::factory()->count(10)->create();
        User::factory()->count(1)->create();
        Instructor::factory()->count(10)->create();
    }
}

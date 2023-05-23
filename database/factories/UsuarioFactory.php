<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usua_nombre' => $this->faker->firstName,
            'usua_apellido' => $this->faker->lastName,
            'usua_documento_tipo' => $this->faker->randomElement(['DNI', 'RUC', 'CE']),
            'usua_documento_nro' => $this->faker->unique()->randomNumber(8),
            'usua_email' => $this->faker->unique()->safeEmail,
            'usua_password' => 'password',
            'usua_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

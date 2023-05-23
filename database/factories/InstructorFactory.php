<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    

    public function definition()
    {
        return [
            'inst_nombre' => $this->faker->firstName,
            'inst_apellido' => $this->faker->lastName,
            'inst_documento_tipo' => $this->faker->randomElement(['DNI', 'RUC', 'CE']),
            'inst_documento_nro' => $this->faker->unique()->numerify('##########'),
            'inst_email' => $this->faker->unique()->safeEmail,
            'inst_password' => 'password', // Puedes personalizar la contraseña aquí
            'inst_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

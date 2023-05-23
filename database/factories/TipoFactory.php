<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tipo>
 */
class TipoFactory extends Factory
{
    

    public function definition()
    {
        return [
            'tipo_nombre' => $this->faker->unique()->word,
            'tipo_descripcion' => $this->faker->sentence,
            'tipo_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

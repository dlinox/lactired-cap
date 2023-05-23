<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recurso>
 */
class RecursoFactory extends Factory
{
   

    public function definition()
    {
        return [
            'recu_nombre' => $this->faker->unique()->word,
            'recu_descripcion' => $this->faker->sentence,
            'recu_tipo' => $this->faker->randomElement(['VIDEO', 'PDF', 'AUDIO']),
            'recu_url' => $this->faker->url,
            'recu_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    

    public function definition()
    {
        return [
            'area_nombre' => $this->faker->unique()->word,
            'area_descripcion' => $this->faker->sentence,
            'area_estado' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

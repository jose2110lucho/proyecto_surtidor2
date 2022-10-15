<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PremioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->text(),
            'unidades' => random_int(1, 10),
            'puntos_requeridos' => random_int(500, 1000),
            'estado' => (bool)random_int(0,1),
        ];
    }
}

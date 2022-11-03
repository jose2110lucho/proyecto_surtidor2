<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'stock' => random_int(1, 30),
            'puntos_requeridos' => random_int(500, 1000),
            'estado' => (bool)random_int(0,1),
            'fecha_inicio' => Carbon::today(),
        ];
    }
}

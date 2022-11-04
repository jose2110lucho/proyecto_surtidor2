<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TanqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $capacidad_max = $this->faker->randomElement(['30000','35000','40000','45000','50000','55000']);
        
        return [
            'codigo' => 'A'.$this->faker->unique()->numberBetween(1, 20),
            'combustible' => $this->faker->randomElement(['gasolina','diesel']),
            'descripcion' => $this->faker->text(),
            'capacidad_max' => $capacidad_max,
            'cantidad_disponible' => $this->faker->numberBetween(10000,$capacidad_max),
            'cantidad_min' => $this->faker->numberBetween(10000, $capacidad_max-10000),
            'estado' => (bool)random_int(0, 1),
        ];
    }
}

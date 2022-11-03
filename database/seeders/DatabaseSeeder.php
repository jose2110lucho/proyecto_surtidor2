<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClienteSeeder::class);
        $this->call(PremioSeeder::class);
        \App\Models\Cliente::factory(20000)->create();
        \App\Models\Tanque::factory(5)->create();
        \App\Models\Premio::factory(5)->create();
        \App\Models\Vehiculo::factory(40000)->create();
    }
}

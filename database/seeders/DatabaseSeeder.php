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
        \App\Models\User::factory(30)->create();
        \App\Models\Cliente::factory(30)->create();
        \App\Models\Tanque::factory(5)->create();
        \App\Models\Premio::factory(20)->create();
        \App\Models\Cliente_Premio::factory(20)->create();
    }
}

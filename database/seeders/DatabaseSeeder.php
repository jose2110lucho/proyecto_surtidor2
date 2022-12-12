<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        \App\Models\Cliente::factory(5)->create();
        \App\Models\Tanque::factory(5)->create();
        \App\Models\Vehiculo::factory(10)->create();
        \App\Models\Producto::factory(50)->create();
    }
}

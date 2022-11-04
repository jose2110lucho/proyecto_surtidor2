<?php

namespace Database\Seeders;

use App\Models\Post;
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

        \App\Models\Cliente::factory(30)->create();
        \App\Models\Tanque::factory(5)->create();
        \App\Models\Premio::factory(20)->create();
        //\App\Models\Cliente_Premio::factory(20)->create();
    }
}

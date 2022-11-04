<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Cristian Arauz Ramirez',
            'email'=> 'cristhianarauz06@gmail.com',
            'password'=>bcrypt('123456789')
        ])->assignRole('Administrador');

        //creando usuarios generados
        User::factory(3)->create();
    }
    
}

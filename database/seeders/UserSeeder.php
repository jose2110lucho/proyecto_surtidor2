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
        $user = new User();

        $user->name = 'Gerald José';
        $user->email = 'geraldjoseavalosseveriche@gmail.com';
        $user->password = '123';
        $user->direccion = 'La Guardia';
        $user->telefono = '70480741';
        $user->estado = true;

        $user->save();
    }
}

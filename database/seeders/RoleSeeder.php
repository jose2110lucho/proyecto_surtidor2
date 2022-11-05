<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Empleado']);


        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'clientes.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.destroy'])->syncRoles([$role1, $role2]);


        /*->syncRoles([$role1,$role2]);


        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Ver lista de usuarios'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.create',
                            'description'=>'Crear usuario'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'editar usuario'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.users.destroy',
                            'description'=>'Eliminar usuario'])->syncRoles([$role1,$role2]);

        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver lista de usuarios'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear usuario'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'editar usuario'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=>'Eliminar usuario'])->syncRoles([$role1,$role2]);
        
        */
    }
}

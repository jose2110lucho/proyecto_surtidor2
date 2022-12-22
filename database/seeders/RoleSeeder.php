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

        Permission::create(['name' => 'admin.home', 'description'=>'Ver dashboard'])->syncRoles([$role1]);
///////////////////CLIENTES///////////////////////
        Permission::create(['name' => 'clientes.index', 'description'=>'Ver lista de clientes'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.create', 'description'=>'Crear nuevo cliente'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.edit', 'description'=>'Editar cliente'])->syncRoles([$role1, $role2]);

///////////////////EMPLEADOS///////////////////////
        Permission::create(['name' => 'empleados.index', 'description'=>'Ver lista de usuarios'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'empleados.create', 'description'=>'Crear nuevo empleado'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'empleados.edit', 'description'=>'Editar Empleado'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'empleados.destroy', 'description'=>'Eliminar Empleado'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.bombas', 'description'=>'Ver bombas'])->syncRoles([$role1]);

///////////////////ROLES///////////////////////
        Permission::create(['name'=>'admin.roles.index', 'description'=>'Ver lista de Roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create', 'description'=>'Crear Rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit', 'description'=>'editar Rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.destroy', 'description'=>'Eliminar Rol'])->syncRoles([$role1]);

///////////////////LISTA DE BOMBAS///////////////////////
Permission::create(['name'=>'userbombas.index', 'description'=>'Ver Bombas'])->syncRoles([$role1,$role2]);

///////////////////VENTAS DE COMBUSTIBLE///////////////////////
Permission::create(['name'=>'venta.combustible.create', 'description'=>'crear venta'])->syncRoles([$role1,$role2]);

///////////////////TANQUE///////////////////////
Permission::create(['name'=>'tanques.recargar', 'description'=>'recargar tanque'])->syncRoles([$role1,$role2]);
Permission::create(['name'=>'tanques.llenar', 'description'=>'llenar tanque'])->syncRoles([$role1,$role2]);
    }
}

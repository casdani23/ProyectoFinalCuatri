<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Supervisor']);
        $role3 = Role::create(['name' => 'Customer']);

        //Autenticacion Admin
        //Permission::create(['name' => '/code'])->syncRoles([$role1]);
        //Permission::create(['name' => '/Envio_Codigo'])->syncRoles([$role1]);
        //Permission::create(['name' => '/Envio_Codigo/dashboard'])->syncRoles([$role1]);

        //Autenticacion Supervisor
        //Permission::create(['name' => '/code'])->syncRoles([$role2]);
        //Permission::create(['name' => '/Envio_Codigo'])->syncRoles([$role2]);
        //Permission::create(['name' => '/Envio_Codigo/dashboard'])->syncRoles([$role2]);

        Permission::create(['name' => '/Dashboard/User.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => '/Dashboard/User.create'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/User.edit'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/User.destroy'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/User/status.status'])->syncRoles([$role1]);

        Permission::create(['name' => '/Dashboard/Products.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => '/Dashboard/Products.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => '/Dashboard/Products.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => '/Dashboard/Products.destroy'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => '/Dashboard/Products/status.status'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => '/Dashboard/Roles.index'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/Roles.create'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/Roles.edit'])->syncRoles([$role1]);
        Permission::create(['name' => '/Dashboard/Roles.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => '/Dashboard/SupervisorToken.index'])->syncRoles([$role2]);

        Permission::create(['name' => '/dashboard.create'])->syncRoles([$role3]);
        Permission::create(['name' => '/dashboard.edit']);
        Permission::create(['name' => '/dashboard.index'])->syncRoles([$role2,$role3]);
        Permission::create(['name' => '/dashboard.destroy'])->syncRoles([$role3]);
        Permission::create(['name' => '/productos/status.status'])->syncRoles([$role3]);
    }
}

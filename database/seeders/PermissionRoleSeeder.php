<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Basic Role
        $admin = Role::findOrCreate("Admin");
        $lembaga = Role::findOrCreate("Lembaga");
        $fakultas = Role::findOrCreate("Fakultas");
        $upa = Role::findOrCreate("UPA");

        // Create Permission
        $this->setPermission("roles");

        // Assign Permission to Role
        $admin->givePermissionTo(Permission::all());
    }

    private function setPermission($resource, $guard = "web")
    {
        Permission::findOrCreate("{$resource}.{$guard}.index");
        Permission::findOrCreate("{$resource}.{$guard}.create");
        Permission::findOrCreate("{$resource}.{$guard}.store");
        Permission::findOrCreate("{$resource}.{$guard}.edit");
        Permission::findOrCreate("{$resource}.{$guard}.update");
        Permission::findOrCreate("{$resource}.{$guard}.delete");
    }
}

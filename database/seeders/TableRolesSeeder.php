<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TableRolesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-events']);
        Permission::create(['name' => 'manage-liste']);
        Permission::create(['name' => 'manage-tavoli']);

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'pr']);

        $superAdminRole->givePermissionTo([
            'manage-users',
            'manage-events',
            'manage-liste',
            'manage-tavoli'
        ]);
        $adminRole->givePermissionTo([
            'manage-users',
            'manage-events',
            'manage-liste',
            'manage-tavoli'
        ]);
    }
}

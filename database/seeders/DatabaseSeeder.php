<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Permission::create(['name' => 'create tenants']);
        Permission::create(['name' => 'view subtenants']);

        // Crear roles
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('create tenants','view subtenants');

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('view subtenants');

        User::factory()->create([
            'name' => 'admin',
            'email' => 'test@example.com',
            'token_login' => 'WYEBMHQ6ZEDJBIPC'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin; // Make sure to import the User model

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create some permissions
        $permissions = [
            'view users',
            'edit users',
            'delete users',
            'create users',
            'view posts',
            'edit posts',
            'delete posts',
            'create posts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['view posts', 'create posts']);

        // Create a dummy user
        $user = Admin::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'), // Make sure to hash the password
        ]);

        // Assign the 'admin' role to the dummy user
        $user->assignRole('admin');
    }
}

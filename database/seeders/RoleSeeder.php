<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create detailed permissions for each section
        $permissions = [
            'manage services',
            'manage bookings',
            'manage offers',
            'manage testimonials',
            'manage faqs',
            'manage blogs',
            'manage messages',
            'manage gallery',
            'manage seo',
            'manage home settings',
            'manage contact settings',
            'view analytics',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        // Create Admin Role and assign all permissions
        $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        // Create SubAdmin Role with limited permissions (as a start)
        $subAdminRole = \Spatie\Permission\Models\Role::create(['name' => 'SubAdmin']);
        $subAdminRole->givePermissionTo([
            'manage bookings', 
            'manage messages', 
            'manage blogs', 
            'manage testimonials'
        ]);

        // Assign Admin role to the first user
        $user = \App\Models\User::first();
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}

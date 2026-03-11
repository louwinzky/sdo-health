<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view_admin_panel',
            'manage_schools',
            'manage_students',
            'manage_health_records',
            'manage_vaccinations',
            'manage_absences',
            'manage_health_programs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $sdoAdminRole = Role::create(['name' => 'sdo_admin']);
        $healthCoordinatorRole = Role::create(['name' => 'health_coordinator']);
        $principalRole = Role::create(['name' => 'principal']);

        // Assign permissions to roles
        $sdoAdminRole->givePermissionTo($permissions); // SDO Admin has all permissions

        $healthCoordinatorRole->givePermissionTo([
            'view_admin_panel',
            'manage_students',
            'manage_health_records',
            'manage_vaccinations',
            'manage_absences',
            'manage_health_programs',
        ]);

        $principalRole->givePermissionTo([
            'view_admin_panel',
            'manage_students',
            'manage_health_records',
        ]);

        // Assign roles to existing users based on their current role column
        User::where('role', 'sdo_admin')->get()->each(function ($user) use ($sdoAdminRole) {
            $user->assignRole($sdoAdminRole);
        });

        User::where('role', 'health_coordinator')->get()->each(function ($user) use ($healthCoordinatorRole) {
            $user->assignRole($healthCoordinatorRole);
        });

        User::where('role', 'principal')->get()->each(function ($user) use ($principalRole) {
            $user->assignRole($principalRole);
        });
    }
}

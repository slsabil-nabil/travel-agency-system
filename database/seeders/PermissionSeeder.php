<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions
        $permissions = [
            // Admin Panel
            'dashboard.view',

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Roles
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Permissions
            'permissions.view',
            'permissions.edit',

            // Agencies
            'agencies.view',
            'agencies.create',
            'agencies.edit',
            'agencies.delete',

            // Bookings
            'bookings.view',
            'bookings.create',
            'bookings.edit',
            'bookings.delete',

            // Accounting
            'invoices.view',
            'invoices.create',
            'invoices.edit',
            'invoices.delete',

            // Reports
            'reports.view',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Define roles and assign permissions
        $roles = [
            'system_admin' => $permissions,

            'agency_admin' => [
                'dashboard.view',
                'users.view', 'users.create', 'users.edit', 'users.delete',
                'bookings.view', 'bookings.create', 'bookings.edit',
                'agencies.view', 'agencies.edit',
                'invoices.view', 'invoices.create',
                'reports.view',
            ],

            'accountant' => [
                'dashboard.view',
                'invoices.view', 'invoices.create', 'invoices.edit',
                'reports.view',
            ],

            'sales' => [
                'dashboard.view',
                'bookings.view', 'bookings.create', 'bookings.edit',
                'invoices.view',
            ],

            'hr' => [
                'dashboard.view',
                'users.view', 'users.create', 'users.edit',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }
    }
}

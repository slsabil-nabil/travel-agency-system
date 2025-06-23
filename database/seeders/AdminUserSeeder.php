<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء المستخدم الإداري
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'agency_id' => 1, // ربطه بوكالة
            ]
        );

        // إنشاء دور admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // الصلاحيات المطلوبة
        $permissions = [
            // العملات
            'view currencies',
            'create currency',
            'edit currency',
            'delete currency',

            // المزودين
            'view suppliers',
            'create supplier',
            'edit supplier',
            'delete supplier',

            // الإعدادات
            'configure settings',
        ];

        // إنشاء الصلاحيات إن لم تكن موجودة
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ربط كل الصلاحيات بدور admin
        $adminRole->syncPermissions($permissions);

        // تعيين الدور للمستخدم
        $user->assignRole($adminRole);
    }
}

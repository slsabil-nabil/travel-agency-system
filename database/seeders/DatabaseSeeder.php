<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            PermissionSeeder::class,
            DemoAgencyUserBookingSeeder::class,

        ]);
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User']
        );
    }
}

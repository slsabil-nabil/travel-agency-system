<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;
use App\Models\User;
use App\Models\Booking;
use Spatie\Permission\Models\Role;

class DemoAgencyUserBookingSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأدوار إذا غير موجودة
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'system_admin']);

        // إنشاء وكالتين
        $agency1 = Agency::create([
            'name' => 'وكالة المستقبل',
            'email' => 'future@example.com',
            'phone' => '777777777',
            'address' => 'صنعاء',
        ]);

        $agency2 = Agency::create([
            'name' => 'وكالة الريادة',
            'email' => 'leader@example.com',
            'phone' => '777888999',
            'address' => 'عدن',
        ]);

        // مستخدمين عاديين مرتبطين بالوكالات
        $user1 = User::create([
            'name' => 'أحمد وكالة المستقبل',
            'email' => 'ahmed@future.com',
            'password' => bcrypt('password'),
            'agency_id' => $agency1->id,
        ]);
        $user1->assignRole('admin');

        $user2 = User::create([
            'name' => 'سارة وكالة الريادة',
            'email' => 'sarah@leader.com',
            'password' => bcrypt('password'),
            'agency_id' => $agency2->id,
        ]);
        $user2->assignRole('admin');

        // مدير نظام عام
        $sysAdmin = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@system.com',
            'password' => bcrypt('password'),
        ]);
        $sysAdmin->assignRole('system_admin');

        // حجوزات مرتبطة بكل وكالة
        Booking::create([
            'agency_id' => $agency1->id,
            'customer_name' => 'خالد المسافر',
            'destination' => 'القاهرة',
            'travel_date' => now()->addDays(10),
            'price' => 1200,
        ]);

        Booking::create([
            'agency_id' => $agency2->id,
            'customer_name' => 'منى المغامرة',
            'destination' => 'إسطنبول',
            'travel_date' => now()->addDays(15),
            'price' => 1500,
        ]);
    }
}

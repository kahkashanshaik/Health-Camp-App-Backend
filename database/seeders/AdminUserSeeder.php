<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new \App\Models\User();
        $admin->name = 'Admin';
        $admin->email = 'kahkashan@standardtouch.com';
        $admin->phone_number = '1234567890';
        $admin->address = '123, ABC Street, XYZ City';
        $admin->role = 'admin';
        $admin->status = 'Active';
        $admin->password = bcrypt('password');
        $admin->save();
    }
}
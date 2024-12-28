<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'address' => 'Dhaka',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'address' => 'Dhaka',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'address' => 'Dhaka',
            'phone' => '1234567890',
            'password' => Hash::make('password'),
        ]);

        $superAdmin->assignRole('admin');
        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}

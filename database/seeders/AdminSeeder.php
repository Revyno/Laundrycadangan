<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@laundry.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_SUPER_ADMIN,
            'phone' => '081234567890',
        ]);

        // Create Admin
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_ADMIN,
            'phone' => '081234567891',
        ]);

        // Create Operator
        User::create([
            'name' => 'Operator Laundry',
            'email' => 'operator@laundry.com',
            'password' => Hash::make('password123'),
            'role' => User::ROLE_OPERATOR,
            'phone' => '081234567892',
        ]);
    }
}
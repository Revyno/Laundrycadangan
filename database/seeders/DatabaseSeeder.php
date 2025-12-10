<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Layanan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Admin (ganti 'super_admin' dengan 'admin')
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // UBAH INI dari 'super_admin' ke 'admin'
            'phone' => '081234567890',
        ]);

        // 2. Buat Operator (ganti 'operator' dengan 'admin' atau hapus jika tidak perlu)
        User::create([
            'name' => 'Operator Laundry',
            'email' => 'operator@laundry.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // UBAH INI dari 'operator' ke 'admin'
            'phone' => '081234567891',
        ]);

        // 3. Buat Customer - TAPI INI SEHARUSNYA MENGGUNAKAN MODEL Customer, BUKAN User
        // Perhatikan: Customer adalah model terpisah dari User
        $customer = Customer::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567892',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'total_points' => 150,
            'membership_level' => 'silver',
        ]);
    }
}

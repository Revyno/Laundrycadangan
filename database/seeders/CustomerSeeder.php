<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Regular Customer
        Customer::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567893',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'total_points' => 50,
            'membership_level' => Customer::MEMBERSHIP_REGULAR,
        ]);

        // Create Silver Customer
        Customer::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567894',
            'address' => 'Jl. Sudirman No. 456, Bandung',
            'total_points' => 150,
            'membership_level' => Customer::MEMBERSHIP_SILVER,
        ]);

        // Create Gold Customer
        Customer::create([
            'name' => 'Bob Johnson',
            'email' => 'bob@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567895',
            'address' => 'Jl. Malioboro No. 789, Yogyakarta',
            'total_points' => 300,
            'membership_level' => Customer::MEMBERSHIP_GOLD,
        ]);

        // Create Platinum Customer
        Customer::create([
            'name' => 'Alice Wilson',
            'email' => 'alice@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567896',
            'address' => 'Jl. Braga No. 101, Bandung',
            'total_points' => 500,
            'membership_level' => Customer::MEMBERSHIP_PLATINUM,
        ]);
    }
}
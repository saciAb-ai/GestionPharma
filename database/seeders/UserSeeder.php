<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Super Admin
        $admin = User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('123456789'),
        ]);
        $admin->assignRole('super-admin');

        // 2. Sales Person
        $sales = User::create([
            'name' => "Vendeur User",
            'email' => "vendeur@gmail.com",
            'password' => Hash::make('123456789'),
        ]);
        $sales->assignRole('sales-person');
    }
}

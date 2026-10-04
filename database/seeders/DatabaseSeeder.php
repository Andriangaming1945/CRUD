<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AccountType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Account Type
        $admin = AccountType::create([
            'name' => 'Admin',
            'description' => 'Administrator account type',
        ]);

        // Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'account_type_id' => $admin->id,
            'status' => 'aktif',
            'identification_number' => 'ADM001',
            'identification_type' => 'NIP',
        ]);
    }
}
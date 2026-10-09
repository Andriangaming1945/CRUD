<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Admin',     'description' => 'Administrator account type'],
            ['name' => 'Dosen',     'description' => 'Akun untuk dosen'],
            ['name' => 'Mahasiswa', 'description' => 'Akun untuk mahasiswa'],
            ['name' => 'Staff',     'description' => 'Akun untuk staff'],
        ];

        foreach ($types as $type) {
            // Kalau nama sudah ada, tidak dibuat dobel
            AccountType::firstOrCreate(
                ['name' => $type['name']],
                ['description' => $type['description']]
            );
        }
    }
}
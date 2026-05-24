<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ReferenceDataSeeder::class);

        User::firstOrCreate(['email' => 'test@example.com'], [
            'name'           => 'Test User',
            'password'       => bcrypt('password'),
            'role'           => 'umkm',
            'profile_status' => 'verified',
        ]);

        User::firstOrCreate(['email' => 'dinas@example.com'], [
            'name'           => 'Petugas Dinas',
            'password'       => bcrypt('password'),
            'role'           => 'dinas',
            'profile_status' => 'verified',
        ]);
    }
}

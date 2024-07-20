<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'nama_jabatan' => 'Admin',
                'jabatan_id' => 'ADM-000',
                'password' => bcrypt('password123')
            ]
        );

        \App\Models\User::factory()->create(
            [
                'name' => 'Merchandise',
                'email' => 'merchandise@gmail.com',
                'username' => 'merchandise',
                'nama_jabatan' => 'Merchandise',
                'jabatan_id' => 'MRC-000',
                'role' => 2,
                'password' => bcrypt('password123')
            ]
        );

        \App\Models\User::factory()->create(
            [
                'name' => 'Warehouse',
                'email' => 'warehouse@gmail.com',
                'username' => 'warehouse',
                'nama_jabatan' => 'Warehouse',
                'jabatan_id' => 'WRH-000',
                'role' => 3,
                'password' => bcrypt('password123')
            ]
        );
    }
}

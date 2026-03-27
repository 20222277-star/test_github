<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // Teacher user
        User::create([
            'name' => 'Giáo viên 1',
            'email' => 'teacher@test.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // Student users
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Sinh viên $i",
                'email' => "student$i@test.com",
                'password' => Hash::make('password'),
                'role_id' => 3,
            ]);
        }
    }
}

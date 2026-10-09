<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gaming.com'],
            [
                'name' => 'System Administrator',
                'password' => 'admin123',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gaming.com'],
            [
                'name' => 'Normal User',
                'password' => 'user123',
                'role' => 'user',
            ]
        );
    }
}
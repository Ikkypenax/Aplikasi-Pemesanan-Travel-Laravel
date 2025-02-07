<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);
        
        User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'lukas',
            'email' => 'lukas@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'johnson',
            'email' => 'johnson@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'alice',
            'email' => 'alice@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}

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
        $user = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('password123')
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alicejohnson@example.com',
                'password' => Hash::make('password123')
            ]

        ];

        foreach ($user as $user) {
            User::create($user);
        }
    }
}

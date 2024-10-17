<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sabrina',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123abc'), // Hash the password
            'role' => 'admin',
            'image' => 'path/to/admin-image.jpg',
        ]);
    }
}

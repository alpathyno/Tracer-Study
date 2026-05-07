<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tracerstudy.sch',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nisn' => null,
        ]);
    }
}
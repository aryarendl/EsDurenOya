<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User owner (hanya 1 akun untuk pemilik)
        User::create([
            'name' => 'Owner Es Duren Oya',
            'email' => 'owner@esdurenoya.com',
            'password' => Hash::make('owner123'),
        ]);

        // Panggil MenuSeeder
        $this->call([
            MenuSeeder::class,
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk mengisi data user awal.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '0', // ENUM disimpan sebagai string
            'status' => 1, // 1 = aktif
            'hp' => '081234567890',
            'password' => Hash::make('P@55word'),
        ]);

        // SuperAdmin
        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopianaji@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234567891',
            'password' => Hash::make('P@55word'),
        ]);

        // Customer
        User::create([
            'nama' => 'Customer Biasa',
            'email' => 'customer@gmail.com',
            'role' => '2',
            'status' => 1,
            'hp' => '081234567892',
            'password' => Hash::make('P@55word'),
        ]);
    }
}

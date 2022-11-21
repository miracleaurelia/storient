<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('admin'),
            'phone' => "089877338849",
            'isAdmin' => true,
            'ktp' => "9283746635536773",
            'address' => "Jln abcdef"
        ]);
        User::create([
            'name' => "Yanto",
            'email' => "yanto@gmail.com",
            'password' => Hash::make('yanto'),
            'phone' => "081263547336",
            'isAdmin' => false,
            'ktp' => "9383746354637882",
            'address' => "Jln Merpati"
        ]);
    }
}

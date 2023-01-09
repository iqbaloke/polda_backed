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
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Pa' Kepo",
            'email' => 'pakepo@gmail.com',
            'level' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Jhon Doe',
            'email' => 'example@gmail.com',
            'level' => 2,
            'password' => Hash::make('password'),
        ]);
    }
}
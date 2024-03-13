<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['email' => 'test1@mail.ru', 'password' => 'password'],
            ['email' => 'test2@mail.ru', 'password' => 'password'],
            ['email' => 'test3@mail.ru', 'password' => 'password']
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            User::create($user);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\bn_BD\Utils;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Testing\Fakes\Fake;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <=3; $i++) {
            $users[]= [
                'email' => 'test@'.($i+1)."mail.ru",
                'password' => Hash::make('password')
            ];
        }
        foreach ($users as $user) {
            if (!User::query()->where('email', $user['email'])->exists()) {
                User::create($user);
            }
        }
    }
}

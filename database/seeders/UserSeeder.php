<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'jlohr@autorisknow.com'],
            [
                'name' => 'Joe Lohr',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'jconsultant@autorisknow.com'],
            [
                'name' => 'John Consultant',
                'password' => bcrypt('password'),
                'role' => 'consultant',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'femployee@dealer.com'],
            [
                'name' => 'Frank Employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'email_verified_at' => now(),
            ]
        );
    }
}

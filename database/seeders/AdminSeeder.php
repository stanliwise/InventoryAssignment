<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $user = User::create([
            'name' => 'User one',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'is_admin' => false,
        ]);

        $user->markEmailAsVerified();

        $admin->markEmailAsVerified();
    }
}

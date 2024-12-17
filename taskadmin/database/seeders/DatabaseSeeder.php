<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'is_super_admin' => true
        ]);
    }
}

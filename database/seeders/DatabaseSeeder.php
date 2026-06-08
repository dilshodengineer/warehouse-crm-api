<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->createUsers();
        $this->call([
            ProductSeeder::class
        ]);
    }

    private function createUsers(): void
    {
        User::firstOrCreate(
            ['username' => 'super_admin'],
            [
                'name' => 'Komiljon',
                'password' => Hash::make('123456'),
                'role' => 'owner'
            ]
        );

        User::firstOrCreate(
            ['username' => 'oddiy_admin'],
            [
                'name' => 'Ali',
                'password' => Hash::make('123456'),
                'role' => 'admin'
            ]
        );
    }
}

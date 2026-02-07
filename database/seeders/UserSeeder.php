<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        $manager = User::firstOrCreate(
            ['email' => 'manager@test.com'],
            [
                'name' => 'Manager',
                'password' => Hash::make('password'),
            ]
        );

        $manager->assignRole($managerRole);
    }
}

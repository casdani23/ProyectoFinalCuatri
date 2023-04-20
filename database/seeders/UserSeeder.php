<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Angel',
            'email' => 'roquerivaldo11@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => true
        ])->assignRole('Admin');

        User::create([
            'name' => 'Hostin',
            'email' => 'hosstin12@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => true
        ])->assignRole('Supervisor');

        User::create([
            'name' => 'Pepe',
            'email' => 'danielcasriv12@gmail.com',
            'password' => Hash::make('123456789'),
            'status' => true
        ])->assignRole('Customer');

        User::factory(0)->create();
    }
}

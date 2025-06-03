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
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Carlos Ninco',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'rol' => 'admin',
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

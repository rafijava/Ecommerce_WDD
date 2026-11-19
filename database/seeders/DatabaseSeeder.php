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
        $this->call([
            ProductSeeder::class,
        ]);

        User::create([
            'name' => 'UrbanFit Admin',
            'email' => 'admin@urbanfitbd.com',
            'password' => Hash::make('UrbanAdmin@2024!'),
            'is_admin' => true,
        ]);
    }
}

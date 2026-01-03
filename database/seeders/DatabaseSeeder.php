<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'SUPERADMIN'
        ]);

        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN'
        ]);

        User::factory(1)->create([
            'name' => 'Fardi',
            'email' => 'fardi@gmail.com',
            'role' => 'CUSTOMER',
            'address' => 'Jl. Malontara No. 123, Kota Palu, Indonesia',
            'phone' => '082345460707',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

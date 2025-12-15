<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@prof.ru',
            'password' => 1111, // password
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'user0',
            'email' => 'user0@prof.ru',
            'password' => 1111, // password
        ]);

        Country::factory(100)->create();
    }
}

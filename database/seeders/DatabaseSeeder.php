<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\users\User::factory(10)->create();

         \App\Models\users\User::factory()->create([
            'name' => 'bandtech User',
            'username' =>'bandtech',
            'email' => 'bandtech@example.com',
            'password' =>'1234@1234',
            'type'    =>'gold',
            'is_active' => true

        ]);


        \App\Models\products\Product::factory(10)->create();
    }
}

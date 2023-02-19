<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //add data to database
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '09785620149',
            'address' => 'Yangon',
            'gender' => 'Male',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}

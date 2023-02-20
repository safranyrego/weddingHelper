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
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Beni',
            'email' => 'beni@weddinghelper.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        
        User::create([
            'name' => 'Regő',
            'email' => 'rego@weddinghelper.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        User::factory(10)->create();
    }
}

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
            'password' => Hash::make('password')
        ]);
        
        User::create([
            'name' => 'Regő',
            'email' => 'rego@weddinghelper.test',
            'password' => Hash::make('password')
        ]);
    }
}

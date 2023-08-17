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
     */
    public function run(): void
    {
        User::create([
            'name'=>'khantnaingwin',
            'email'=>'admin@gmail.com',
            'address'=>'taungup',
            'phone'=>'09661327163',
            'role'=>'admin',
            'gender'=>'male',
            'password'=>Hash::make('khant123'),

        ]);
    }
}

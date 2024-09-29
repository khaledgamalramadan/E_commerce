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
            "fname"=> "khaled",
            "lname"=> "gamal",
            "email"=> "khaled@gmail.com",
            "password"=> Hash::make("12345678"),
            "is_admin"=> 1


        ]);
    }
}

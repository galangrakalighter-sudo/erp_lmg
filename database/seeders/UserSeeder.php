<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("admin123"),
                "role" => "admin",
                "remember_token" => Str::random(10),
                "created_at" => now(),
                "updated_at" => now() 
            ],
            [
                "name" => "cust",
                "email" => "cust@gmail.com",
                "password" => bcrypt("admin123"),
                "role" => "customer",
                "remember_token" => Str::random(10),
                "created_at" => now(),
                "updated_at" => now() 
            ]
        ]);
    }
}

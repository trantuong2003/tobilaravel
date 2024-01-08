<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;//dặt mật khẩu
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \DB::table("users")->insert([
            "name" =>"admin",
            "email" =>"admin@gmail.com",
            "password" =>\Hash::make("admin123"),
            'role' => 'admin',
        ]);       
        //  \DB::table("users")->insert([
        //     "name" =>"user",
        //     "email" =>"user@gmail.com",
        //     "password" =>\Hash::make("user123"),
        //     'role' => 'user',
        // ]);

    }
}

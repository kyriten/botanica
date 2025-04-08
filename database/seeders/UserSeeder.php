<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "username" => "Admin",
            "email" => "admin@taksonomiapp.com",
            "password" => bcrypt("123456"),
        ]);
    }
}

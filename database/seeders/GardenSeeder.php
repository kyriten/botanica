<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GardenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("gardens")->insert([
            'name' => 'Kebun Raya Bogor',
            'slug' => 'krbogor',
        ]);
        DB::table("gardens")->insert([
            'name' => 'Kebun Raya Cibodas',
            'slug' => 'krcibodas',
        ]);
        DB::table("gardens")->insert([
            'name' => 'Kebun Raya Purwodadi',
            'slug' => 'krpurwodadi',
        ]);
        DB::table("gardens")->insert([
            'name' => 'Kebun Raya Bedugul',
            'slug' => 'krbedugul',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_kab = public_path('json/cities.json');
        $json_kab = file_get_contents($file_kab);
        $data_kab = json_decode($json_kab, true);

        echo "Memulai proses seeder data Kota/Kabupaten...\n";
        DB::table('cities')->insert($data_kab);
        echo "Done seeder data Kota/Kabupaten...\n";

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_kec = public_path('json/districts.json');
        $json_kec = file_get_contents($file_kec);
        $data_kec = json_decode($json_kec, true);
        $chunk_kec = array_chunk($data_kec, 1000);
        foreach ($chunk_kec as $key => $chunk) {
            echo "Memulai proses seeder data Kecamatan... ke " . $key + 1 . "000\n";
            DB::table('districts')->insert($chunk);
            echo "Done seeder data Kecamatan... ke " . $key + 1 . "000\n";
        }
    }
}

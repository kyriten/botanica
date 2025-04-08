<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_kel = public_path('json/villages.json');
        $json_kel = file_get_contents($file_kel);
        $data_kel = json_decode($json_kel, true);
        $chunk_kel = array_chunk($data_kel, 1000);
        foreach ($chunk_kel as $key => $chunk) {
            echo "Memulai proses seeder data Kelurahan... ke " . $key + 1 . "000\n";
            DB::table('villages')->insert($chunk);
            echo "Done seeder data Kelurahan... ke " . $key + 1 . "000\n";
        }
    }
}

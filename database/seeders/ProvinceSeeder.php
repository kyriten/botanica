<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_prov = public_path('json/provinces.json');
        $json_prov = file_get_contents($file_prov);
        $data_prov = json_decode($json_prov, true);

        echo "Memulai proses seeder data Provinsi...\n";
        DB::table('provinces')->insert($data_prov);
        echo "Done seeder data Provinsi...\n";

    }
}

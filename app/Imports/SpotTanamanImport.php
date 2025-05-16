<?php

namespace App\Imports;

use App\Models\Map;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpotTanamanImport implements ToModel, WithHeadingRow
{
    /**
     * Mengambil data per baris dan memasukkannya ke model Map
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Pastikan kolom "local" ada pada file yang diupload
        if (!isset($row['local'])) {
            throw new \Exception('Kolom "local" tidak ditemukan dalam file. Pastikan kolom pertama adalah "local".');
        }

        return new Map([
            'local'          => $row['local'],
            'latin'          => $row['latin'],
            'slug'           => Str::slug(($row['local'] ?? '') . ' ' . ($row['latin'] ?? '')),
            'kingdom'        => $row['kingdom'],
            'sub_kingdom'    => $row['sub_kingdom'],
            'super_division' => $row['super_division'],
            'division'       => $row['division'],
            'class'          => $row['class'],
            'sub_class'      => $row['sub_class'],
            'ordo'           => $row['ordo'],
            'famili'         => $row['famili'],
            'genus'          => $row['genus'],
            'species'        => $row['species'],
            'description'    => $row['description'],
            'garden_name'    => $row['garden_name'],
            'garden_id'      => session('selected_garden_id')
        ]);
    }
}

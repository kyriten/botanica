<?php

namespace App\Imports;

use App\Models\Map;
use App\Models\Garden;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class SpotTanamanImport implements ToModel, WithHeadingRow, SkipsOnFailure
{
    use SkipsFailures;

    protected $duplicates = [];
    protected $missingGardens = [];

    public function model(array $row)
    {
        // Ambil dan normalisasi lokasi
        $rawLocation = trim($row['lokasi'] ?? '-');
        $normalizedLocation = str_contains(strtolower($rawLocation), 'kebun raya')
            ? $rawLocation
            : 'Kebun Raya ' . $rawLocation;

        // Cari garden_id dari tabel gardens
        $garden = Garden::where('name', $normalizedLocation)->first();
        $gardenId = $garden->id ?? null;

        // Jika kebun tidak ditemukan, simpan ke list missing
        if (!$gardenId) {
            $this->missingGardens[] = [
                'lokasi_excel' => $rawLocation,
                'lokasi_diharapkan' => $normalizedLocation,
                'nama_lokal' => $row['nama_lokal'] ?? '',
                'nama_latin' => $row['nama_latin'] ?? '',
            ];
            return null;
        }

        // Cek duplikat berdasarkan nama lokal, latin, dan garden_id
        $exists = Map::where('local', $row['nama_lokal'])
            ->where('latin', $row['nama_latin'])
            ->where('garden_id', $gardenId)
            ->exists();

        if ($exists) {
            $this->duplicates[] = [
                'row'    => $row,
                'reason' => 'Data dengan nama lokal dan latin sudah ada untuk kebun ini.',
            ];
            return null;
        }

        // Pisahkan koordinat
        [$latitude, $longitude] = [null, null];
        if (!empty($row['titik_koordinat'])) {
            $coords = explode(',', $row['titik_koordinat']);
            $latitude = trim($coords[0] ?? '');
            $longitude = trim($coords[1] ?? '');
        }

        // Simpan data ke model Map
        return new Map([
            'category'        => $row['jenis_tanaman'] ?? '-',
            'famili'          => $row['family'] ?? '-',
            'local'           => $row['nama_lokal'] ?? '-',
            'latin'           => $row['nama_latin'] ?? '-',
            'slug'            => Str::slug(($row['nama_lokal'] ?? '') . ' ' . ($row['nama_latin'] ?? '')),
            'kingdom'         => $row['kingdom'] ?? null,
            'sub_kingdom'     => $row['sub_kingdom'] ?? null,
            'super_division'  => $row['super_divisi'] ?? null,
            'division'        => $row['divisi'] ?? null,
            'class'           => $row['kelas'] ?? null,
            'sub_class'       => $row['sub_kelas'] ?? null,
            'ordo'            => $row['ordo'] ?? null,
            'genus'           => $row['genus'] ?? null,
            'species'         => $row['spesies'] ?? null,
            'description'     => $row['deskripsi'] ?? null,
            'garden_name'     => $normalizedLocation,
            'garden_id'       => $gardenId,
            'plant_lat'       => $latitude,
            'plant_long'      => $longitude,
        ]);
    }

    public function getDuplicates(): array
    {
        return $this->duplicates;
    }

    public function getMissingGardens(): array
    {
        return $this->missingGardens;
    }
}

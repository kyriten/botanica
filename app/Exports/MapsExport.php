<?php

namespace App\Exports;

use App\Models\Map;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MapsExport implements FromCollection, WithHeadings, WithTitle
{
    protected $maps;
    protected $gardenName;

    public function __construct($maps, $gardenName)
    {
        $this->maps = $maps;
        $this->gardenName = $gardenName;
    }

    // Menyediakan data yang akan diekspor
    public function collection()
    {
        return $this->maps;
    }

    // Menyediakan headings untuk spreadsheet
    public function headings(): array
    {
        return [
            'local',
            'latin',
            'slug',
            'kingdom',
            'sub_kingdom',
            'super_division',
            'division',
            'class',
            'sub_class',
            'ordo',
            'famili',
            'genus',
            'species',
            'description',
            'plant_lat',
            'plant_long',
            'garden_name'
        ];
    }

    // Menyediakan nama sheet sesuai dengan nama kebun
    public function title(): string
    {
        return $this->gardenName;
    }
}

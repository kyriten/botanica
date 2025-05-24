<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithTitle,
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithMapping
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MapsExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths, WithEvents, WithMapping
{
    protected $maps;
    protected $gardenName;

    public function __construct($maps)
    {
        $this->maps = $maps;
        $this->gardenName = "Data Tumbuhan";
    }

    public function collection()
    {
        return collect($this->maps);
    }

    public function map($row): array
    {
        static $rowIndex = 1;
        $no = $rowIndex++;
        $pad = str_pad($no, 3, '0', STR_PAD_LEFT);

        // Closure untuk hyperlink atau strip jika null
        $linkOrDash = function($label, $url) {
            return $url ? ['text' => $label, 'url' => $url] : '-';
        };

        return [
            $no,
            $row->category,
            $row->famili,
            $row->latin,
            $row->local,
            $row->kingdom,
            $row->sub_kingdom,
            $row->super_division,
            $row->division,
            $row->class,
            $row->sub_class,
            $row->ordo,
            $row->genus,
            $row->species,
            $row->description,
            $linkOrDash('A' . $pad, $row->plant_image),
            $linkOrDash('B' . $pad, $row->stem_image),
            $linkOrDash('C' . $pad, $row->leaf_image),
            $linkOrDash('D' . $pad, $row->flower_image),
            $linkOrDash('E' . $pad, $row->fruit_image),
            $linkOrDash('F' . $pad, $row->another_image),
            $row->garden_name,
            "{$row->plant_lat}, {$row->plant_long}",
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenis Tanaman',
            'Famili',
            'Nama Latin',
            'Nama Lokal',
            'Kingdom',
            'Sub Kingdom',
            'Super Divisi',
            'Divisi',
            'Kelas',
            'Sub Kelas',
            'Ordo',
            'Genus',
            'Spesies',
            'Deskripsi',
            'Foto Keseluruhan (A)',
            'Foto Batang (B)',
            'Foto Daun (C)',
            'Foto Bunga (D)',
            'Foto Buah (E)',
            'Foto Lain-lain (F)',
            'Lokasi',
            'Titik Koordinat',
        ];
    }

    public function title(): string
    {
        return $this->gardenName;
    }

    public function styles(Worksheet $sheet)
    {
        // Heading style
        $sheet->getStyle('A1:W1')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Times New Roman',
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'A9D08E'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Body style
        $sheet->getStyle('A2:W' . ($this->maps->count() + 1))->applyFromArray([
            'font' => ['name' => 'Times New Roman'],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 11.86,
            'B' => 30.57,
            'C' => 23.57,
            'D' => 23.57,
            'E' => 24,
            'F' => 24,
            'G' => 24,
            'H' => 24,
            'I' => 24,
            'J' => 24,
            'K' => 24,
            'L' => 24,
            'M' => 24,
            'N' => 24,
            'O' => 54.43,
            'P' => 22,
            'Q' => 22,
            'R' => 22,
            'S' => 22,
            'T' => 22,
            'U' => 22,
            'V' => 22,
            'W' => 22,
        ];
    }

    public function registerEvents(): array
    {
        return [
            \Maatwebsite\Excel\Events\AfterSheet::class => function (\Maatwebsite\Excel\Events\AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $totalRows = $this->maps->count();

                // Header row height
                $sheet->getRowDimension(1)->setRowHeight(85.5);

                // Dynamic row heights, deskripsi kosong diberi tinggi 85.5
                foreach (range(2, $totalRows + 1) as $row) {
                    $description = $sheet->getCell("O$row")->getValue();
                    if (!$description) {
                        $sheet->getRowDimension($row)->setRowHeight(85.5);
                    } else {
                        $sheet->getRowDimension($row)->setRowHeight(-1); // auto height
                    }
                }

                // Set hyperlink di kolom foto, jika array url ada
                foreach (range(2, $totalRows + 1) as $i) {
                    foreach (range('P', 'U') as $col) { // P sampai U adalah kolom foto (15-20)
                        $cell = $sheet->getCell("$col$i");
                        $value = $cell->getValue();

                        if (is_array($value) && isset($value['url']) && $value['url']) {
                            $sheet->getCell("$col$i")->getHyperlink()->setUrl($value['url']);
                            $sheet->setCellValue("$col$i", $value['text']);
                        } elseif ($value === '-') {
                            $sheet->setCellValue("$col$i", '-');
                        }
                    }
                }
            }
        ];
    }
}

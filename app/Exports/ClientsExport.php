<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Customer::select('id', 'tipo_documento', 'numero_documento', 'nombres', 'apellidos')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tipo_documento' => $item->tipo_documento,
                    'numero_documento' => $item->numero_documento,
                    'nombres' => $item->nombres,
                    'apellidos' => $item->apellidos,
                ];
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'tipo_documento',
            'numero_documento',
            'nombres',
            'apellidos',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para el encabezado
            1 => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => ['fillType' => 'solid', 'color' => ['argb' => 'FF1A73E8']]
            ],
            // Bordes para toda la tabla
            'A1:D' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => ['borderStyle' => 'thin', 'color' => ['argb' => 'FF000000']]
                ]
            ]
        ];
    }
}

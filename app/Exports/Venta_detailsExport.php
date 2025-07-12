<?php

namespace App\Exports;

use App\Models\Sale_detail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Venta_detailsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Sale_detail::select('id', 'user_id', 'customer_id', 'fecha', 'total', 'tipo_comprobante', 'igv', 'subtotal')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'user_id' => $item->user_id,
                    'customer_id' => $item->product_id,
                    'fecha' => $item->fecha,
                    'total' => $item->total,
                    'tipo_comprobante' => $item->tipo_comprobante,
                    'igv' => $item->igv,
                    'subtotal' => $item->subtotal,
                ];
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'sale_id',
            'product_id',
            'cantidad',
            'precio_unitario',
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

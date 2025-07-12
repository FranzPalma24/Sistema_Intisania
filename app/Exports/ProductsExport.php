<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Product::select('id','supplier_id', 'name', 'description', 'codigo_barra','precio_venta','precio_compra','stock','stock_minimo','status')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    // 'category_id    ' => $item->category_id,
                    'supplier_id' => $item->supplier_id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'codigo_barra' => $item->codigo_barra,
                    'precio_venta' => $item->precio_venta,
                    'precio_compra' => $item->precio_compra,
                    'stock' => $item->stock,
                    'stock_minimo' => $item->stock_minimo,
                    'status' => $item->status ? 'Activo' : 'Inactivo'
                ];
            });
    }

    public function headings(): array
    {
        return [
            '#',
            // 'ID Categoria',
            'ID Proveedor',
            'nombre',
            'description',
            'codigo_barra',
            'precio_venta',
            'precio_compra',
            'stock',
            'stock_minimo',
            'Estado'
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

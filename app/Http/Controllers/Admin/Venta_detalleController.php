<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Venta_detailsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Venta_detalleController extends Controller
{
    public function index()
    {
        return view('admin.venta_detalle.index');
    }


     public function exportExcel()
    {
        return Excel::download(new Venta_detailsExport, 'reporte_Venta_detalle.xlsx');
    }
}

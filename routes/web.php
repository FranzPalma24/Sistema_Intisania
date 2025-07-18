<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\Compra_detalleController;
use App\Http\Controllers\Admin\CompraController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\Venta_detalleController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    /*Categoria */
    Route::resource('categoria', CategoriaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.categoria');
    Route::get('categoria/export-pdf', [CategoriaController::class, 'exportPdf'])->name('admin.categoria.export-pdf');
    Route::get('categoria/export-excel', [CategoriaController::class, 'exportExcel'])->name('admin.categoria.export-excel');
    /*Proveedor */
    Route::resource('proveedor', ProveedorController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.proveedor');
    Route::get('proveedor/export-pdf', [ProveedorController::class, 'exportPdf'])->name('admin.supplier.export-pdf');
    Route::get('proveedor/export-excel', [ProveedorController::class, 'exportExcel'])->name('admin.supplier.export-excel');
    /*Producto */
    Route::resource('producto', ProductoController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.producto');
    Route::get('producto/export-pdf', [ProductoController::class, 'exportPdf'])->name('admin.producto.export-pdf');
    Route::get('producto/export-excel', [ProductoController::class, 'exportExcel'])->name('admin.producto.export-excel');
    /*Compra */
    Route::resource('compra', CompraController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.compra');
    Route::get('compra/export-pdf', [CompraController::class, 'exportPdf'])->name('admin.compra.export-pdf');
    Route::get('compra/export-excel', [CompraController::class, 'exportExcel'])->name('admin.compra.export-excel');
    /*Compra detalle */
    Route::resource('compra_detalle', Compra_detalleController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.compra_detalle');
    Route::get('compra_detalle/export-pdf', [Compra_detalleController::class, 'exportPdf'])->name('admin.compra_detalle.export-pdf');
    Route::get('compra_detalle/export-excel', [Compra_detalleController::class, 'exportExcel'])->name('admin.compra_detalle.export-excel');
    /*Cliente */
    Route::resource('cliente', ClienteController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.cliente');
    Route::get('cliente/export-pdf', [ClienteController::class, 'exportPdf'])->name('admin.cliente.export-pdf');
     Route::get('cliente/export-excel', [ClienteController::class, 'exportExcel'])->name('admin.cliente.export-excel');
    /*Venta */
    Route::resource('venta', VentaController::class)->only(['index', 'store'])->names('admin.venta');
    /*Venta detalle */
    Route::resource('venta_detalle', Venta_detalleController::class)->only(['index'])->names('admin.venta_detalle');
    Route::get('venta_detalle/export-excel', [Venta_detalleController::class, 'exportExcel'])->name('admin.venta_detalle.export-excel');
    // Ruta para consultar DNI
    Route::get('cliente/consultar-dni', [ClienteController::class, 'consultarDni'])->name('admin.cliente.consultar-dni');
    // Ruta para consultar RUC
    Route::get('/proveedor/consultar-ruc', [ProveedorController::class, 'consultarRuc'])->name('admin.proveedor.consultar-ruc');
    // Ruta para consultar producto por código
    Route::post('/venta/get-product', [VentaController::class, 'getProduct'])->name('admin.venta.get-product');
    // Ruta para consultar cliente por DNI
    Route::post('/venta/get-customer', [VentaController::class, 'getCustomer'])->name('admin.venta.get-customer');
    // Rutas para notificaciones
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllAsRead');
});

require __DIR__.'/auth.php';

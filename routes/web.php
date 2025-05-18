<?php

use App\Http\Controllers\BienController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EnteController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('entes', App\Http\Controllers\EnteController::class);
Route::resource('bienes', BienController::class);
Route::get('bienes/{id}/edit', [BienController::class, 'edit'])->name('bienes.editar');

Route::resource('departamentos', App\Http\Controllers\DepartamentoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('movimientos', MovimientoController::class);
Route::get('/departamentos-data/{ente}', [DepartamentoController::class, 'getByEnte'])->name('departamentos.byEnte');
Route::get('/bienes-activos', [BienController::class, 'bienesActivos'])->name('bienes.activos');
Route::get('/salidas', [MovimientoController::class, 'salidas'])->name('salidas.index');
Route::get('/salidas/create', [MovimientoController::class, 'createSalida'])->name('salidas.create');
Route::post('/bienes/disponibles', [BienController::class, 'bienesDisponibles'])->name('bienes.disponibles');
Route::post('/salidas/store', [MovimientoController::class, 'storeSalida'])->name('salidas.store');
Route::get('/salidas/show/{id}', [MovimientoController::class, 'showSalida'])->name('salidas.show');
Route::get('/inventario', [BienController::class, 'inventario'])->name('bienes.inventario');
Route::get('/inventario/edit/{id}', [BienController::class, 'editInventario'])->name('bienes.editInventario');
Route::put('/inventario/update/{id}', [BienController::class, 'actualizarBienAsignado'])->name('bienes.actualizarBienAsignado');
Route::delete('/inventario/delete/{id}', [BienController::class, 'destroyBienAsignado'])->name('bienes.destroyBienAsignado');
Route::get('/exportar-bienes', [BienController::class, 'exportBienesPorDepartamento'])->name('exportar.bienes.departamento');
Route::get('/exportar/entradas-fecha', [MovimientoController::class, 'exportEntradasPorFecha'])->name('exportar.entradas.fecha');
Route::get('/exportar/salidas-fecha', [MovimientoController::class, 'exportSalidasPorFecha'])->name('exportar.salidas.fecha');
Route::get('/inventario/pdf/{id}', [PdfController::class, 'pdfBienInventario'])->name('pdf.inventario');


});


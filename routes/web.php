<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/matkul/add', [App\Http\Controllers\HomeController::class, 'tambahMatkul'])->name('tambah-matkul');
Route::post('/matkul/add', [App\Http\Controllers\HomeController::class, 'tambahMatkulAction'])->name('tambah-matkul-action');
Route::get('/matkul/edit/{id}', [App\Http\Controllers\HomeController::class, 'editMatkul'])->name('edit-matkul');
Route::post('/matkul/edit', [App\Http\Controllers\HomeController::class, 'editMatkulAction'])->name('edit-matkul-action');
Route::get('/matkul/delete/{id}', [App\Http\Controllers\HomeController::class, 'deleteMatkulAction'])->name('delete-matkul-action');

Route::get('/transaksi', [App\Http\Controllers\HomeController::class, 'indexTransaksi'])->name('transaksi');
Route::get('/transaksi/add', [App\Http\Controllers\HomeController::class, 'addTransaksi'])->name('add-transaksi');
Route::post('/transaksi/add', [App\Http\Controllers\HomeController::class, 'addTransaksiAction'])->name('add-transaksi-action');
Route::post('/laporan/cetak', [App\Http\Controllers\HomeController::class, 'cetakLaporan'])->name('cetak-laporan');

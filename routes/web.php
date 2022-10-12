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

Route::get('/soal', [App\Http\Controllers\HomeController::class, 'indexSoal'])->name('soal');
Route::get('/soal/add', [App\Http\Controllers\HomeController::class, 'addSoal'])->name('add-soal');
Route::get('/soal/list/{kode_soal}', [App\Http\Controllers\HomeController::class, 'listSoal'])->name('list-soal');
Route::post('/soal/add', [App\Http\Controllers\HomeController::class, 'addSoalAction'])->name('add-soal=action');
Route::post('/soal/list/add', [App\Http\Controllers\HomeController::class, 'addListSoalAction'])->name('add-list-soal=action');
Route::get('/kerjakan/{tr_data_code}/{data_jawaban_code}/{tr_soal_code}', [App\Http\Controllers\HomeController::class, 'kerjakanSoal']);
Route::post('/kerjakan', [App\Http\Controllers\HomeController::class, 'kerjakanSoalAction']);
Route::post('/simpan_jawaban', [App\Http\Controllers\HomeController::class, 'simpanJawaban']);
Route::get('/hasil/{tr_data_code}/{data_jawaban_code}', [App\Http\Controllers\HomeController::class, 'hasilUjian']);

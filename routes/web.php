<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;

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

Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome', [
            'title' => 'Halaman Utama'
        ]);
    });
    Route::get('/home', function () {
        return view('welcome', [
            'title' => 'Halaman Utama'
        ]);
    });
    Route::get('/logout', [AuthController::class, 'logout']);
    // ALTERNATIF
    Route::resource('alternatif', AlternatifController::class);
    Route::get('/dataTablesAlternatif', [AlternatifController::class, 'dataTables']);
    // KRITERIA
    Route::resource('/kriteria', KriteriaController::class);
    Route::get('/dataTablesKriteria', [KriteriaController::class, 'dataTablesKriteria']);
    Route::get('/kriteriaEdit/{kreteria:uuid}', [KriteriaController::class, 'edit']);
    Route::resource('/subKriteria', SubKriteriaController::class);
    Route::get('/dataTablesSubKriteria', [KriteriaController::class, 'dataTablesSubKriteria']);
    // PERHITUNGAN
    Route::get('/perhitungan', [PerhitunganController::class, 'index']);
    Route::post('/perhitungan-update/{perhitungan:uuid}', [PerhitunganController::class, 'update']);
    Route::post('/cari-keputusan', [PerhitunganController::class, 'cari_keputusan']);
    // RANKING
    Route::get('/ranking', [LaporanController::class, 'laporan_ranking']);
});

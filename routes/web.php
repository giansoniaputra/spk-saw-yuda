<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
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
            'title' => 'Dashboard'
        ]);
    });
    Route::get('/home', function () {
        return view('welcome', [
            'title' => 'Dashboard'
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
});

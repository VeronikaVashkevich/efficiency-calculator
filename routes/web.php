<?php

use App\Http\Controllers\EnergyEfficiencyController;
use App\Http\Controllers\FrequencyEfficiencyController;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::resource('energy', EnergyEfficiencyController::class);
Route::resource('frequency', FrequencyEfficiencyController::class);

Route::get('/history', [IndexController::class, 'history'])->name('history');
Route::get('/download-pdf/{type}/{id}', [IndexController::class, 'downloadPdf'])->name('downloadPdf');
Route::get('/download-xls/{type}/{id}', [IndexController::class, 'downloadXLS'])->name('downloadXLS');

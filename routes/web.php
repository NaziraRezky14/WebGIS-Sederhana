<?php

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
    return view('home');
    Route::get('/edit_data/{id}', [App\Http\Controllers\HalamanData::class, 'edit'])->name('edit data');
Route::post('/update_data/{id}', [App\Http\Controllers\HalamanData::class, 'update'])->name('update data');
Route::get('/delete_data/{id}', [App\Http\Controllers\HalamanData::class, 'destroy'])->name('delete data');
Route::get('/tambah_data', [App\Http\Controllers\HalamanData::class, 'create'])->name('tambah data');
Route::get('/home', [App\Http\Controllers\TematikController::class, 'index'])->name('halaman tematik');
Route::get('/home', [App\Http\Controllers\TematikController::class, 'create'])->name('tambah tematik');
Route::post('/input_tematik', [App\Http\Controllers\TematikController::class, 'store'])->name('data tematik');
Route::get('/edit_tematik/{id}', [App\Http\Controllers\TematikController::class, 'edit'])->name('edit tematik');
Route::post('/update_tematik/{id}', [App\Http\Controllers\TematikController::class, 'update'])->name('update tematik');
Route::get('/delete_tematik/{id}', [App\Http\Controllers\TematikController::class, 'destroy'])->name('delete tematik');
});

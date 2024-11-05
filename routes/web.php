<?php

use App\Http\Controllers\DataBarangController;
use Illuminate\Support\Facades\Route;

Route::resource('data_barang', DataBarangController::class);
Route::delete('/data_barang/delete/{id}', [DataBarangController::class, 'destroy'])->name('data_barang.destroy');
Route::get('/data_barang/delete/{id}', function ($id) {
    return redirect()->route('data_barang.index')->withErrors(['error' => 'ID tidak ada.']);
})->name('data_barang.delete.invalid');

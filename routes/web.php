<?php

use App\Http\Controllers\Web\GaleriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GaleriController::class, 'index'])->name('galeri.index');
Route::prefix('galeri')->group(function () {
    Route::get('/{galeri}', [GaleriController::class, 'show'])->name(
        'galeri.show'
    );
    Route::get('/edit/{galeri}', [GaleriController::class, 'edit'])->name(
        'galeri.edit'
    );
    Route::post('/', [GaleriController::class, 'store'])->name('galeri.store');
    Route::patch('/{galeri}', [GaleriController::class, 'update'])->name(
        'galeri.update'
    );
    Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name(
        'galeri.destroy'
    );
});
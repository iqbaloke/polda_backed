<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\Web\GaleriController;
use App\Http\Controllers\Web\MediaWebController;
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

Route::prefix('media')->group(function () {
    Route::get('/', [MediaWebController::class, 'index'])->name(
        'media.index'
    );
    Route::get('/{media}', [MediaWebController::class, 'show'])->name(
        'media.show'
    );
    // Route::get('/edit/{media}', [MediaWebController::class, 'edit'])->name(
    //     'media.edit'
    // );
    Route::post('/', [MediaWebController::class, 'store'])->name('media.store');
    Route::patch('/{media}', [MediaWebController::class, 'update'])->name(
        'media.update'
    );
    Route::delete('/{media}', [MediaWebController::class, 'destroy'])->name(
        'media.destroy'
    );
});